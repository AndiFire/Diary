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
               <time-ago class="text-xs items-center" :dateTime="comment.created_at" />
            </div>
            <p>{{ comment.content }}</p>
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
   },
   components: {
      TimeAgo,
      Icon,
      LikePlace,
   },

   data() {
      return {
         comments: [],
         newComment: ''
      }
   },

   mounted() {
      this.fetchComments();
   },

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
         this.comments.push(comment);
         this.newComment = '';
      }
   },
}
</script>
