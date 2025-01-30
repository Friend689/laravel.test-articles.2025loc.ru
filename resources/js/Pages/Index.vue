<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';
import CardArticle from '@/Pages/Articles/Partials/CardArticle.vue';

const props = defineProps({
    articles: Object,
})
</script>

<template>

  <Head title="Главная страница" />

  <MainLayout>
    <section class="bg-gray-200">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="font-semibold text-xl leading-tight">Главная страница</h1>
      </div>
    </section>

    <section class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <div class="flex flex-wrap justify-center my-6">
        <CardArticle v-for="(article, articleIndex) in props.articles" :key="articleIndex" :data="article" url="articles" class="m-4"></CardArticle>
      </div>
    </section>

  </MainLayout>

</template>

<!-- <style scoped lang="scss"></style> -->
