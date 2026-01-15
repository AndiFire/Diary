<template>
   <button @click="like" :class="{ liked: isLiked }">
      <span v-if="isLiked">❤️</span>
      <span v-else>🤍</span>
      {{ likesCount }}
   </button>
</template>

<script>
export default {
   props: {
      type: String,
      id: Number,
      initialLikesCount: Number,
      userLiked: Boolean
   },
   data() {
      return {
         likesCount: this.initialLikesCount,
         isLiked: this.userLiked
      };
   },
   watch:{
      userLiked(val){
         this.isLiked = val;
      },
      initialLikesCount(val){
         this.likesCount = val;
      }
   },
   methods: {
      async like() {
         const csrfMeta = document.querySelector('meta[name="csrf-token"]');
         const csrf = csrfMeta ? csrfMeta.content : null;
         if (!csrf) {
            console.error('CSRF token not found');
            return;
         }

         const res = await fetch('/like', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
               'Content-Type': 'application/json',
               'X-CSRF-TOKEN': csrf
            },
            body: JSON.stringify({ type: this.type, id: this.id })
         });

         if (!res.ok) {
            console.error('Like request failed', res.status, await res.text());
            return;
         }

         const data = await res.json();
         this.likesCount = data.likes_count;
         this.isLiked = data.user_liked;
      }
   }
}
</script>