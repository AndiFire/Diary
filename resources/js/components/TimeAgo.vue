<template>
   <span>{{ convertedDateTime }}</span>
</template>
<script>
import moment from 'moment';
export default {
   name: "TimeAgo",
   props:{
      dateTime:{
         required: true,
      }
   },
   computed:{
      convertedDateTime(){
         return moment(this.dateTime).fromNow();
      }
   }
}
</script>