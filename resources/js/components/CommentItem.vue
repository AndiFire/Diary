<template>
   <li class="pt-4">
      <div class="flex items-center">
         <h1 :class="comment.user.id === authUserId ? 'text-activeColor-dark' : 'text-textColor dark:text-textColor-dark'"
            class="font-bold text-sm ">{{ comment.user.name }}
         </h1>
         <p v-if="comment.user.id === noteAuthorId" class="text-xs pl-2 text-textSecColor dark:text-textSecColor-dark">(Author)</p>
         <span class=" mx-1 text-textSecColor dark:text-textSecColor-dark">•</span>  <!--сделать чтобы мой коммент был выше всех-->

         <div class="flex" :ref="`menu-${comment.id}`">
            <div v-if="comment.created_at != comment.updated_at">
               <p class="text-xs mr-1">Updated {{ comment.updated_comment }}</p>
            </div>
            <div v-else class="">
               <p class="text-xs mr-1 ">{{ comment.created_comment }}</p>
            </div>

            <button v-if="comment.user.id === authUserId" @click.stop="toggleMenu(comment.id)">
               <icon name="more" class="w-4 h-4" />
            </button>
            <div v-if="openMenuId === comment.id"
               class="relative -mt-16 z-50 w-24 h-16 items-start pl-2 justify-center flex flex-col rounded-lg bg-black/10 shadow-2xl">

               <button @click="startEdit(comment)" class="flex items-center space-x-1 hover:text-yellow-600">
                  <p>Edit</p>
                  <icon name="edit" class="w-4 h-4" />
               </button>
               <button @click="deleteComment(comment.id)" class="flex items-center space-x-1 hover:text-red-700">
                  <p>Delete</p>
                  <icon name="trash" class="w-4 h-4" />
               </button>

            </div>
         </div>
      </div>

      <p v-if="editingCommentId !== comment.id">
         {{ comment.content }}
      </p>

      <div v-else class="relative flex items-center w-full">
         <input v-model="editContent" ref="editInput"
            class="w-full bg-transparent border border-borderColor dark:border-borderColor-dark rounded-lg px-2 py-1 pr-12"
            @keydown.enter="updateComment(comment.id)" @keydown.esc="cancelEdit" />
         <button type="button" @click.stop="updateComment(comment.id)"
            class="absolute right-2 flex items-center justify-center" aria-label="Send comment">
            <icon name="send" />
         </button>
      </div>

      <div class="flex items-center justify-start space-x-1">
         <div class="">
            <like-place class="like" type="comment" :id="comment.id" :initial-likes-count="comment.likes_count"
               :user-liked="comment.user_liked" />
         </div>

         <div class=" hover:bg-black/20 p-2 rounded-full ">
            <button @click="showReplyForm = !showReplyForm" class="text-xs flex space-x-1 items-center">
               <icon name="comment" class="" />
               <p>Reply</p>
            </button>
         </div>
      </div>

      <div v-if="showReplyForm" class="mt-2 ml-4">
         <form @submit.prevent="addReply">
            <div class="relative">
               <input v-model="newReply" type="text" placeholder="Write a reply..."
                  class="w-full bg-transparent border border-borderColor dark:border-borderColor-dark rounded-lg px-2 py-1 pr-12">
               <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2"
                  aria-label="Send reply">
                  <icon name="send" />
               </button>
            </div>
         </form>
      </div>

      <div v-if="comment.children && comment.children.length" class="">
         <button @click="showReplies = !showReplies" class="text-xs  hover:underline">
            {{ showReplies ? 'Hide' : 'Show' }} replies ({{ comment.children.length }})
         </button>
      </div>

      <ul v-if="comment.children && comment.children.length && showReplies"
         class=" border-l border-borderColor dark:border-borderColor-dark pl-6 ">
         <comment-item v-for="child in comment.children" :key="child.id" :comment="child" :auth-user-id="authUserId"
            :note-author-id="noteAuthorId" :note-id="noteId" @reply="$emit('reply', $event)"
            @edit="$emit('edit', $event)" @delete="$emit('delete', $event)" />
      </ul>
   </li>
</template>

<script>
import Icon from './IconLoader.vue'
import LikePlace from './LikePlace.vue'

export default {
   name: 'CommentItem',
   props: {
      comment: {
         type: Object,
         required: true
      },
      authUserId: Number,
      noteId: Number,
      noteAuthorId: Number,
   },
   components: {
      Icon,
      LikePlace,
   },
   data() {
      return {
         openMenuId: null,
         editingCommentId: null,
         editContent: '',
         showReplyForm: false,
         newReply: '',
         showReplies: false,
      };
   },
   methods: {
      toggleMenu(id) {
         this.openMenuId = this.openMenuId === id ? null : id
      },
      startEdit(comment) {
         this.editingCommentId = comment.id
         this.editContent = comment.content
         this.openMenuId = null
         this.$nextTick(() => {
            this.$refs.editInput?.focus()
         })
      },
      cancelEdit() {
         this.editingCommentId = null
         this.editContent = ''
      },
      async updateComment(commentId) {
         if (!this.editContent.trim()) {
            this.cancelEdit()
            return
         }

         const res = await fetch(`/notes/${this.noteId}/comments/${commentId}`, {
            method: 'PUT',
            credentials: 'same-origin',
            headers: {
               'Content-Type': 'application/json',
               'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ content: this.editContent })
         })

         if (!res.ok) return

         const updated = await res.json()

         this.comment.content = updated.content
         this.comment.updated_at = updated.updated_at
         this.comment.updated_comment = updated.updated_comment

         this.cancelEdit()
      },
      async deleteComment(commentId) {
         if (!confirm('Are you sure you want to delete this comment?')) return;

         const res = await fetch(`/notes/${this.noteId}/comments/${commentId}`, {
            method: 'DELETE',
            headers: {
               'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
         });

         if (res.ok) {
            this.$emit('delete', commentId)
         }
      },
      async addReply() {
         if (!this.newReply.trim()) return;

         const res = await fetch(`/notes/${this.noteId}/comments`, {
            method: 'POST',
            headers: {
               'Content-Type': 'application/json',
               'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ content: this.newReply, parent_id: this.comment.id })
         });

         const reply = await res.json();
         reply.likes_count = 0;
         reply.user_liked = false;
         if (!this.comment.children) this.comment.children = [];
         this.comment.children.push(reply);
         this.newReply = '';
         this.showReplyForm = false;
      },
   },
}
</script>