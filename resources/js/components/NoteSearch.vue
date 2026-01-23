<template>

   <div class="flex-col flex items-center py-4 px-6">

      <div class="flex md:w-80">
         <div class="relative w-full">
            <input ref="searchInput" v-model="search" type="text" placeholder="Search..."
               class="bg-zinc-500/20 rounded-full py-1 pl-10 block w-full " @input="fetchNotes"
               @keydown.enter.prevent="confirmSearch">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
               <button type="button" @click.prevent="confirmSearch"
                  class=" flex items-center justify-center rounded-full focus:outline-none">
                  <icon class="w-5 h-5" name="search-normal" />
               </button>
            </div>
         </div>
      </div>

      <div class="flex text-sm mt-2">
         <span class=" opacity-70">{{ notes.length }} notes found</span>
      </div>

   </div>

   <ul v-if="notes.length > 0" class="pt-0.5 h-[340px] overflow-y-auto hide-scroll border-x border-borderColor/50 dark:border-borderColor-dark/50 dark:bg-white/5 bg-black/5">
      <li v-for="note in notes" :key="note.id" class="px-2 py-1 m-1 flex-1 cursor-pointer shadow-lg rounded-lg min-w-0 bg-bgColor dark:bg-bgColor-dark">
         <a :href="`/user/notes/${note.id}`" class="flex-1 flex items-center justify-between min-w-0">
            <span class="truncate block">{{ note.title }}</span>
         </a>

         <p class=" border-b border-borderColor/50 dark:border-borderColor-dark/50 truncate block text-textSecColor dark:text-textSecColor-dark">
            {{ note.content }}
         </p>

         <div class="flex justify-between items-center pt-1 text-textSecColor dark:text-textSecColor-dark">
            <div class="flex">
               <div v-if="note.created_at != note.updated_at">
                  <p class="text-xs">Updated {{ note.updated_human }}</p>
               </div>
               <div v-else class="">
                  <p class="text-xs mr-3 ">{{ note.published_human }}</p>
               </div>
            </div>
            <div class="flex items-center ">
               <div class="opacity-85" :class="{'text-activeColor dark:text-activeColor-dark': note.published, '' : !note.published}">
                  <icon name="check" />
               </div>
               <button @click="deleteNote(note.id)" class=" hover:text-red-700">
                  <icon name="trash" class=""/>
               </button>
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
      // title: {
      //    type: String,
      //    default: "My diary entries"
      // },
      type: { 
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
   watch: {
      type: {
         immediate: true,
         handler() {
            this.fetchNotes();
         }
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