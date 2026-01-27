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
         <comment-item v-for="comment in comments" :key="comment.id" :comment="comment" :auth-user-id="authUserId"
            :note-author-id="noteAuthorId" :note-id="noteId" @reply="handleReply" @edit="handleEdit"
            @delete="handleDelete" />
      </ul>
   </div>
</template>

<script>
import TimeAgo from './TimeAgo.vue'
import Icon from './IconLoader.vue'
import LikePlace from './LikePlace.vue'
import CommentItem from './CommentItem.vue'
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
      CommentItem,
   },

   data() {
      return {
         comments: [],
         newComment: '',
         openMenuId: null,
         editingCommentId: null,
         editContent: '',
         noteAuthorId: null,
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
         const data = await res.json();
         this.comments = data.comments;
         this.noteAuthorId = data.note_author_id;
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
         comment.children = [];
         this.comments.push(comment);
         this.newComment = '';
      },

      handleReply(reply) {
         // Обработка добавления ответа, если нужно
      },
      handleEdit(updatedComment) {
         // Обработка редактирования, если нужно
      },
      handleDelete(commentId) {
         this.comments = this.comments.filter(comment => comment.id !== commentId);
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
