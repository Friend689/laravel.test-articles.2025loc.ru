<script setup>

defineProps({
  icon: String,
})
</script>

<template>
  <template v-if="icon === 'eye'">
    <svg class="feather feather-eye" fill="none" height="24" stroke="currentColor" stroke-linecap="round"
      stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
      <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
      <circle cx="12" cy="12" r="3" />
    </svg>
  </template>
  <template v-else-if="icon === 'like'">
    <svg class="feather feather-thumbs-up" fill="none" height="24" stroke="currentColor" stroke-linecap="round"
      stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
      <path
        d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3" />
    </svg>
  </template>
  <template v-else-if="icon === 'favorite'">
    <svg class="feather feather-heart" fill="none" height="24" stroke="currentColor" stroke-linecap="round"
      stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
      <path
        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
    </svg>
  </template>
</template>
