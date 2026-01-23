<template>
   <div class="">
      <form @submit.prevent="addComment">
         <div class="relative order-1 border-borderColor dark:border-borderColor-dark mb-4">
            <input v-model="newComment" type="text" placeholder="Share your thoughts"
               class=" bg-transparent rounded-xl py-2 pr-40 block ">
            <button type="submit" class="absolute inset-y-0 right-0 pr-3 flex items-center" aria-label="Send comment">
               <icon name="send" />
            </button>
         </div>
      </form>

      <ul>
         <li class="py-4" v-for="comment in comments" :key="comment.id">
            <div class="flex items-center">
               <h1 class="font-bold text-sm text-textColor dark:text-textColor-dark">{{ comment.user.name }}</h1>
               <span class=" mx-1 text-textSecColor dark:text-textSecColor-dark">•</span>

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
                  <div
                     v-if="openMenuId === comment.id"
                     class="relative -mt-16 z-50 w-24 h-16 items-start pl-2 justify-center flex flex-col rounded-lg bg-black/10 shadow-2xl">

                        <button @click="startEdit(comment)" class="flex items-center space-x-1 hover:text-yellow-600">
                           <p>Edit</p><icon name="edit" class="w-4 h-4"/>
                        </button>
                        <button @click="deleteComment(comment.id)" class="flex items-center space-x-1 hover:text-red-700">
                           <p>Delete</p><icon name="trash" class="w-4 h-4"/>
                        </button>

                  </div>
               </div>
            </div>

            <p v-if="editingCommentId !== comment.id">
               {{ comment.content }}
            </p>

            <div v-else class="relative flex items-center w-full">
               <input
                  v-model="editContent"
                  ref="editInput"
                  class="w-full bg-transparent border border-borderColor dark:border-borderColor-dark rounded-lg px-2 py-1 pr-12"
                  @keydown.enter="updateComment(comment.id)"
                  @keydown.esc="cancelEdit"
               />
               <button
                  type="button"
                  @click.stop="updateComment(comment.id)"
                  class="absolute right-2 flex items-center justify-center"
                  aria-label="Send comment"
               >
                  <icon name="send" />
               </button>
            </div>

            <div class="">
               <like-place type="comment" :id="comment.id" :initial-likes-count="comment.likes_count"
                  :user-liked="comment.user_liked" />
            </div>

         </li>
      </ul>

   </div>
</template>

<script>
import TimeAgo from './TimeAgo.vue'
import Icon from './IconLoader.vue'
import LikePlace from './LikePlace.vue'
export default {

   props: {
      noteId: {
         type: Number,
         required: true
      },
      authUserId: Number,
   },
   components: {
      TimeAgo,
      Icon,
      LikePlace,
   },

   data() {
      return {
         comments: [],
         newComment: '',
         openMenuId: null,
         editingCommentId: null,
         editContent: '',
      };
   },
   mounted() {
      this.fetchComments();
      document.addEventListener('keydown', this.handleEscape);
      document.addEventListener('click', this.handleClickOutside);
   },
   beforeDestroy() {
      document.removeEventListener('click', this.handleClickOutside);
   },
   destroyed() {
      document.removeEventListener('keydown', this.handleEscape);
   },

//METHODS------------------------------------------------------------------------

   methods: {
      async fetchComments() {
         const res = await fetch(`/notes/${this.noteId}/comments`);
         this.comments = await res.json();
      },
      async addComment() {
         if (!this.newComment.trim()) return;

         const res = await fetch(`/notes/${this.noteId}/comments`, {
            method: 'POST',
            headers: {
               'Content-Type': 'application/json',
               'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ content: this.newComment })
         });

         const comment = await res.json();
         comment.likes_count = 0;
         comment.user_liked = false;
         this.comments.push(comment);
         this.newComment = '';
      },

   //EDIT------------------------------------------------------------------------------

      startEdit(comment) {
      this.editingCommentId = comment.id
      this.editContent = comment.content
      this.openMenuId = null
      this.$nextTick(() => {
         this.$refs[`editInput-${comment.id}`]?.focus()
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

      const index = this.comments.findIndex(c => c.id === commentId)
      this.comments[index].content = updated.content
      this.comments[index].updated_at = updated.updated_at
      this.comments[index].updated_comment = updated.updated_comment

      this.cancelEdit()
      },

   //DELETE---------------------------------------------------------------------

      async deleteComment(commentId) {
         if (!confirm('Are you sure you want to delete this comment?')) return;

         const res = await fetch(`/notes/${this.noteId}/comments/${commentId}`, {
            method: 'DELETE',
            headers: {
               'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
         });

         if (res.ok) {
            this.comments = this.comments.filter(comment => comment.id !== commentId);
         }
      },

      // POPUP FROM USERMENU-----------

      toggleMenu(id) {
      this.openMenuId = this.openMenuId === id ? null : id
      },

      handleClickOutside(e) {
      if (!this.openMenuId) return

      const ref = this.$refs[`menu-${this.openMenuId}`]
         if (ref && !ref.contains(e.target)) {
            this.openMenuId = null
         }
      },

      handleEscape(e) {
         if (e.key === 'Escape') {
            this.openMenuId = null
         }
      }

   },
}
</script>
