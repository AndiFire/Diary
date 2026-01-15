<template>

      <div class="flex justify-between items-center border-b py-4 px-6">
         <div class="flex-col w-1/2">
            <h2 class="font-bold text-lg text-textColor dark:text-textColor-dark">
               {{ title }}
            </h2>
            <span class="text-sm opacity-70">{{ notes.length }} notes</span>
         </div>

         <div class="w-1/2 flex justify-end">
            <input v-model="search" @input="fetchNotes" placeholder="Search..." class="bg-zinc-500/20 rounded-full py-1 pl-10 w-full" />
         </div>
      </div>

      <ul v-if="notes.length > 0" class="mt-1 max-h-60 overflow-y-auto hide-scroll p-2">
         <li v-for="note in notes" :key="note.id" class="p-2 cursor-pointer shadow-lg rounded-lg min-w-0">
            <a :href="`/user/notes/${note.id}`" class="flex-1 flex items-center justify-between min-w-0">
               <span class="truncate block">{{ note.title }}</span>
            </a>

            <p class="text-textSecColor dark:text-textSecColor-dark border-b border-borderColor/50 dark:border-borderColor-dark/50 truncate block">
               {{ note.content }}
            </p>

            <div class="flex justify-between items-center pt-1">
               <p class="text-xs mr-3 text-textSecColor dark:text-textSecColor-dark">
                  {{ note.published_human }}
               </p>
               <div v-if="note.created_at != note.updated_at">
                  <p class="text-sm opacity-60 custom-text-gradient">Updated {{ note.updated_human }}</p>
               </div>
            </div>
         </li>
      </ul>

      <div v-else class="mt-1 w-full shadow-lg rounded-xl p-2 text-gray-500">
         Nothing found
      </div>

</template>

<script>
export default {
   props: {
      user: Object,
      title: {
         type: String,
         default: "My diary entries"
      },
      type: { // 'all' | 'liked'
         type: String,
         default: 'all'
      }
   },
   data() {
      return {
         search: "",
         notes: [],
         _timer: null
      };
   },
   methods: {
      fetchNotes() {
         clearTimeout(this._timer);
         this._timer = setTimeout(() => {
         const userId = this.user?.id || '';
         fetch(`/notes/search?user_id=${userId}&type=${this.type}&q=${encodeURIComponent(this.search)}`)
            .then(res => res.json())
            .then(data => {
               this.notes = data.notes || data;
            });
         }, 300);
      }
   },
   mounted() {
      this.fetchNotes();
   },
   beforeUnmount() {
      clearTimeout(this._timer);
   }
};
</script>