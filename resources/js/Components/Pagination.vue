<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  links: Array,
})
</script>

<template>
  <div v-if="links.length > 3">
    <div class="flex flex-wrap -mb-1">
      <template v-for="(link, linkIndex) in links">
        <div v-if="link.url === null" :key="key"
          class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
          <Link v-else :key="linkIndex" :href="link.url" v-html="link.label" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
          :class="{ 'bg-white': link.active }"/>
      </template>
    </div>
  </div>
</template>
