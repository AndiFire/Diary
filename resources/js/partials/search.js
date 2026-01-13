const input = document.getElementById('searchInput');
const container = document.getElementById('noteContainer');
let t;

input.addEventListener('input', function(){
   clearTimeout(t);
   t = setTimeout(() => {
      fetch(`/diary/search?q=${input.value}`)
         .then(response => response.json())
         .then(data => {
            container.innerHTML = data.html;
         });
   });
});