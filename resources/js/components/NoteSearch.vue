<template>

   <div ref="searchBox" class="rounded-2xl h-1/2 mb-8 bg-bgColor dark:bg-bgColor-dark ">
      <div class="flex row justify-center items-center border-b border-slate-600 w-full py-4 px-6 ">
         <div class="flex-col text-inline-flex w-1/2">
            <h2 class="flex font-bold text-lg text-textColor dark:text-textColor-dark ">My diary entries</h2>
            <span class="text-sm opacity-70">{{ notes.length }} notes</span>
         </div>
         <div class="w-1/2 flex justify-end items-center">
            <div class="relative ml-12">

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
      </div>

      <div v-if="notes.length > 0" class="mt-1 w-full rounded-lg max-h-60 overflow-x-hidden hide-scroll p-2">
         <ul>
            <li v-for="note in notes" :key="note.id" class="items-center p-2 cursor-pointer shadow-lg rounded-lg min-w-0">
               <a :href="`/user/notes/${note.id}`" class="flex-1 flex items-center justify-between min-w-0">
                  <span class="truncate block">
                     {{ note.title }}
                  </span>
               </a>

               <p class="text-textSecColor dark:text-textSecColor-dark border-b border-borderColor/50 dark:border-borderColor-dark/50 truncate block">
                  {{ note.content }}
               </p>

               <div class="flex justify-between items-center pt-1 ">
                  <p class="flex justify-end text-xs mr-3 cursor-pointer text-textSecColor dark:text-textSecColor-dark" >
                     {{note.published_human}}
                  </p>
                  <div v-if="note.created_at != note.updated_at">
                     <p class="flex text-sm opacity-60 custom-text-gradient ">Updated {{ note.updated_human }}</p>
                  </div>
               </div>
            </li>
         </ul>
      </div>

      <div v-if="search.length > 0 && notes.length === 0" class="  mt-1 w-full shadow-lg rounded-xl p-2 text-gray-500 ">
         Nothing found
      </div>

   </div>
</template>

<script>
export default {
   props: ['user'],
   data() {
      return {
         search: "",
         notes: [],
         _timer: null,
      };
   },
   methods: {
      performSearch() {
         const userId = this.user && this.user.id ? this.user.id : '';
         if (!this.search || this.search.length === 0) {
            this.loadUserNotes();
            return;
         }
         fetch(`/notes/search?q=${encodeURIComponent(this.search)}&user_id=${encodeURIComponent(userId)}`)
            .then(res => res.json())
            .then(data => {
               this.notes = data.notes || data;
            });
      },
      fetchNotes() {
         clearTimeout(this._timer);
         this._timer = setTimeout(() => {
            this.performSearch();
         }, 300);
      },
      confirmSearch() {
         clearTimeout(this._timer);
         this.performSearch();
         if (this.$refs.searchInput && typeof this.$refs.searchInput.blur === 'function') {
            this.$refs.searchInput.blur();
         }
      },
      loadUserNotes() {
         const userId = this.user && this.user.id ? this.user.id : '';
         fetch(`/notes/search?user_id=${encodeURIComponent(userId)}`)
            .then(res => res.json())
            .then(data => {
               this.notes = data.notes || data;
            });
      },
      handleClickOutside(event) {
         if (this.$refs.searchBox && !this.$refs.searchBox.contains(event.target)) {
            this.search = "";
            this.loadUserNotes();
         }
      },
      openNote(id) {
         window.location.href = `/notes/${id}/edit`;
      }
   },
   computed: {
      noteCount() {
         return this.notes.length;
      }
   },
   mounted() {
      document.addEventListener("click", this.handleClickOutside);
      if (!this.search || this.search.length === 0) {
         this.loadUserNotes();
      }
   },
   beforeUnmount() {
      document.removeEventListener("click", this.handleClickOutside);
   },
};

</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
   transition: opacity 0.3s;
}

.fade-enter-from,
.fade-leave-to {
   opacity: 0;
}
</style>