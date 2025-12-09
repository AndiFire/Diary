<script setup>
import { defineAsyncComponent, ref } from 'vue';

const props = defineProps({
  name: {
    type: String,
    required: true,
  },
});

// собрать все иконки
const icons = import.meta.glob('../icons/*.svg', { as: 'component' });

// выбрать загрузчик по имени
const loader = icons[`../icons/${props.name}.svg`];

const icon = loader ? defineAsyncComponent(loader) : null;
</script>

<template>
  <component v-if="icon" :is="icon" class="fill-current" />
  <span v-else class="inline-block w-4 h-4 bg-red-400">!</span>
</template>