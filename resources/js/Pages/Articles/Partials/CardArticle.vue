<script setup>
import Icon from '@/Components/Icon.vue';
import { useUtility } from '@/utils/utils';

const { convertDateToHuman, cutContentText } = useUtility();

defineProps({
  type: {
    type: String,
    default: 'min',
  },
  data: {
    type: Object,
  },
  url: {
    type: String,
    default: 'articles',
  }
});

</script>

<template>
  <div :class="[type === 'min' ? 'max-w-xs' : 'max-w-full']" class="card p-5 bg-white rounded-lg shadow-md">
    <div class="card__preview-image mb-4">
      <img class="rounded-lg" :src="`/images/card-${type === 'min' ? 'small' : 'large'}.jpg`" alt="">
    </div>
    <div class="mt-2 grow">
      <a :class="[type === 'min' ? 'text-xl' : 'text-2xl']" class="card__title text-gray-700 font-bold hover:underline h-full" :href="`${url}/${data?.id}`">
        {{ data?.title }} </a>
      <p class="mt-2 text-gray-600"> {{ cutContentText(data?.content) }} </p>
    </div>
    <div class="flex justify-between items-center mt-4">
      <div v-if="type !== 'min'" class="flex flex-wrap">
        <div class="m-1 px-2 py-1 w-fit rounded-full bg-gray-500 text-white" v-for="tag in data.tags" :key="tag.id">#{{ tag.label }}</div>
      </div>
      <a class="text-blue-500 hover:underline nowrap" :href="`${url}/${data?.id}`">Read more</a>
    </div>
    <div class="mt-4 flex justify-between items-center">
      <div class="flex items-center">
        <span :class="[type === 'min' ? 'order-1' : 'order-2']" class="flex font-light text-gray-600"> {{ convertDateToHuman(data?.created_at) }} </span>
        <div v-if="type !== 'min'" class="order-2 flex items-center">
          <img class="mx-4 w-10 h-10 object-cover rounded-full hidden sm:block" src="/images/avatar.jpg" alt="avatar">
          <h1 class="text-gray-700 font-bold hover:underline"> {{ data.author.name }} </h1>
        </div>
      </div>
      <div class="flex">
        <div class="flex align-center">
          <Icon icon="eye" class="mx-2" title="count views" />
          <span>{{ data.views }}</span>
        </div>
        <div class="flex align-center">
          <Icon icon="favorite" class="mx-2" title="count likes" />
          <span>{{ data.likes }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.card {
    display: flex;
    flex-direction: column;
}
.card__title {
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    text-overflow: ellipsis;
    max-height: 3em;
}
</style>
