import './bootstrap';
import { createApp } from 'vue';


const app = createApp({});

import UserMenu from './components/UserMenu.vue';
import BurgerMenu from './components/BurgerMenu.vue';
import PasswordInput from './components/PasswordInput.vue'
import NoteComments from './components/NoteComments.vue'
import TimeAgo from './components/TimeAgo.vue'
import IconLoader from './components/IconLoader.vue'
import LikePlace from './components/LikePlace.vue'
import ChangeAvatar from './components/ChangeAvatar.vue';
import NoteSearch from './components/NoteSearch.vue';

app.component('user-menu', UserMenu);
app.component('burger-menu', BurgerMenu);
app.component('password-input', PasswordInput);
app.component('note-comments', NoteComments);
app.component('time-ago', TimeAgo);
app.component('icon', IconLoader);
app.component('like-button', LikePlace);
app.component('change-avatar', ChangeAvatar);
app.component('note-search', NoteSearch);

app.mount('#app');
