<template>
   <div class="flex-col w-full h-full rounded-2xl bg-bgColor dark:bg-bgColor-dark px-10 pb-10 ">
      <div class="flex gap-6 border-b border-borderColor/20 dark:border-borderColor-dark/20 mb-2 w-full justify-center ">
         <button @click="setTab('all')" :class="tabClass('all')">Notes</button>
         <button @click="setTab('liked')" :class="tabClass('liked')">Liked Notes</button>
      </div>

      <div class="rounded-2xl w-full bg-bgColor dark:bg-bgColor-dark ">
         <note-search :user="user" :type="activeTab" :title="tabTitle"></note-search>
      </div>
   </div>
</template>
<script>
import NoteSearch from './NoteSearch.vue';

export default {

   components: { NoteSearch },
   props: {
      user: Object
   },

   data() {
      return {
         activeTab: 'all'
      }
   },

   computed: {
      tabTitle() {
         return this.activeTab === 'all' ? 'Notes' : 'Liked Notes'
      }
   },

   methods: {
      setTab(tab) {
         this.activeTab = tab;
      },
      tabClass(tab) {
         return [
            'pb-2 font-medium',
            this.activeTab === tab ? 'border-b-2 border-activeColor dark:border-activeColor-dark' : 'opacity-60 hover:opacity-100'
         ]
      }
   }
}
</script>