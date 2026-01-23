<template>
   <div class="relative inline-block text-left" ref="menuContainer">
      <button @click="toggleMenu"
         class="block relative z-10 h-8 w-8 rounded-full overflow-hidden border-2 border-gray-600 focus:outline-none transition duration-150 focus:border-blue-500 ">
         <img class="h-full w-full object-cover"
               :src="user.avatar_url"
               alt="User avatar">
      </button>

      <!-- <button v-if="isOpen" @click="closeMenu" tabindex="-2" class=" fixed inset-0 h-full w-full cursor-default"></button> -->
      <div v-if="isOpen"
         class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-bgSecColor dark:bg-bgSecColor-dark shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none"
         role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
         <div class="flex pb-2 p-4 text-sm text-textColor dark:text-textColor-dark hover:text-hoverColor dark:hover:text-hoverColor-dark border-b cursor-pointer">   
               <a :href="`/user/show/${user.id}`" class=""> 
               <h1> {{ user.name }} </h1>
               <p> {{ user.email }} </p>
            </a>
         </div>
         <div class="pt-2 p-4 text-textSecColor dark:text-textSecColor-dark block  text-sm" role="none">

               <a :class="{ active: isProfileRoute }" :href="`/user/edit/${user.id}`" 
                  class="hover:text-hoverColor dark:hover:text-hoverColor-dark block mb-2" role="menuitem" tabindex="-1"
                  id="menu-item-0">Account settings</a>
               <a href="#" class="hover:text-hoverColor dark:hover:text-hoverColor-dark block mb-2" role="menuitem"
                  tabindex="-1" id="menu-item-1">Support</a>
               <a href="#" class="hover:text-hoverColor dark:hover:text-hoverColor-dark block mb-2" role="menuitem"
                  tabindex="-1" id="menu-item-2">License</a>

               <button type="submit" class="text-textSecColor dark:text-textSecColor-dark hover:text-hoverColor dark:hover:text-hoverColor-dark block w-full text-left text-sm"
                  role="menuitem" tabindex="-1" id="menu-item-3">
                  <a href="/" @click="logout" class="block w-full border-t pt-2">Sign out</a>
               </button>

         </div>
      </div>
   </div>
</template>
<script>
import axios from 'axios';

export default {

   name: "UserMenu",
   props: {
      user: {
      type: Object,
      required: true
      }
   },
   data: function(){
      return {
         isOpen: false,

      };
   },
   computed: {
   },
   mounted() {
      document.addEventListener('keydown', this.handleEscape);
      document.addEventListener('click', this.handleClickOutside);
   },

   beforeDestroy() {
      document.removeEventListener('click', this.handleClickOutside);
   },

   destroyed() {
      // Удаляем обработчик события при уничтожении компонента
      document.removeEventListener('keydown', this.handleEscape);

   },

   // -------------------
   methods: {

      // POPUP FROM USERMENU-----------
      handleClickOutside(event) {
         if (this.isOpen && !this.$refs.menuContainer.contains(event.target)) {
               this.isOpen = false;
         }
      },

      toggleMenu() {
         this.isOpen = !this.isOpen;
      },
      closeMenu() {
         this.isOpen = false;
      },

      //______________________________________

      handleEscape(e) {
         if (e.key === 'Escape' || e.key === 'Esc') {
               this.isOpen = false;
         }
      },

      logout() {
         axios.get('/logout')
         .then(response => {
               this.$router.push("/");
               // Дополнительные действия, которые нужно выполнить после выхода
         })
         .catch(error => {
               console.error(error);
         });
      },

   }
}
</script>

