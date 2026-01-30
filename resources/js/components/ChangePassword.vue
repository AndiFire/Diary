<template>

   <button @click="OpenModal"
      class="rounded-xl text-textColor-dark dark:text-textColor-dark text-sm py-1 px-4 hover:scale-105 duration-300 bg-buttonColor dark:bg-buttonColor-dark">
      <p>Change</p>
   </button>

   <div v-show="showModal" class="fixed inset-0 z-50 grid place-items-center bg-black/50 ">
      <div class="relative p-4 w-full max-w-md">
         <!-- Modal content -->
         <div class="relative bg-bgSecColor rounded-lg shadow dark:bg-bgSecColor-dark ">

            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
               <h3 class="text-xl font-semibold text-textColor dark:text-textColor-dark">
                  Change your Nickname
               </h3>
               <button type="button" @click="closeModal"
                  class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 14 14">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                  </svg>
                  <span class="sr-only">Close modal</span>
               </button>
            </div>

            <!-- Modal body -->
            <div class="p-4 md:p-5 text-textSecColor dark:text-textSecColor-dark">
               <form @submit.prevent="changeName">

                  <label for="new_name" class="block mb-1 text-sm font-medium ">New name</label>
                  <div class="relative">
                     <input id="new_name" type="text" v-model="newName"
                        class="mb-4 p-2 rounded-lg text-sm border-none block w-full bg-bgColor dark:bg-bgColor-dark text-textColor dark:text-textColor-dark focus:outline-none focus:ring-0"
                        :class="{ 'border-red-600 placeholder-red-600': errors.new_name }">
                  </div>
                  <p v-if="errors.new_name" class="text-red-600 text-xs mb-4">{{ errors.new_name[0] }}</p>

                  <label for="new_name_confirmation"
                     class="block mb-1 text-sm font-medium ">Confirm new name</label>
                  <div class="relative">
                     <input id="new_name_confirmation" type="text" v-model="newNameConfirmation"
                        class="mb-4 p-2 rounded-lg text-sm border-none  block w-full bg-bgColor dark:bg-bgColor-dark text-textColor dark:text-textColor-dark focus:outline-none focus:ring-0"
                        :class="{ 'border-red-600 placeholder-red-600': errors.new_name_confirmation }">
                  </div>
                  <p v-if="errors.new_name_confirmation" class="text-red-600 text-xs mb-4">{{
                     errors.new_name_confirmation[0] }}</p>

                  <div class="flex justify-center">
                     <button type="submit"
                        class="rounded-xl text-gray-200 py-1 px-6 hover:scale-105 duration-300 bg-buttonColor dark:bg-buttonColor-dark disabled:opacity-50 disabled:cursor-not-allowed"
                        :disabled="loading">
                        {{ loading ? 'Saving...' : 'Save' }}
                     </button>
                  </div>

               </form>
            </div>
         </div>
      </div>
   </div>


</template>

<script>
export default {
   props: {
      user: {
         type: Object,
         required: true
      }
   },
   data() {
      return {
         newName: this.user.name,
         newNameConfirmation: '',
         errors: {},
         loading: false,
         showModal: false
      }
   },
   methods: {
      OpenModal() {
         this.errors = {};
         this.showModal = true;
      },
      closeModal() {
         this.showModal = false;
      },

      async changeName() {
         this.loading = true;
         this.errors = {};
         try {
            const response = await fetch('/change-name', {
               method: 'POST',
               headers: {
               'Content-Type': 'application/json',
               'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
               },
               body: JSON.stringify({
               new_name: this.newName,
               new_name_confirmation: this.newNameConfirmation
               })
            });

            if (!response.ok) {
               // Ловим ошибки сервера
               const data = await response.json().catch(() => ({}));
               this.errors = data.errors || { general: ['Something went wrong'] };
               return;
            }

            // Всё ок
            this.closeModal();

            // Ждём немного, чтобы модалка исчезла, потом редирект
            setTimeout(() => {
               window.location.href = `/user/edit/${this.user.id}`;
            }, 100); 

         } catch (error) {
            this.errors = { general: ['Network error'] };
         } finally {
            this.loading = false;
         }
      },

   }
}
</script>