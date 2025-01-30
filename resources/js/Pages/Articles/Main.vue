<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';
import CardArticle from './Partials/CardArticle.vue';
import Pagination from '@/Components/Pagination.vue';

defineProps({
  articles: Object,
  tags: Array,
})

</script>

<template>

  <Head title="Articles" />

  <MainLayout>
    <section class="bg-gray-200">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="font-semibold text-xl leading-tight">Каталог статей</h1>
      </div>
    </section>

    <section class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between">
        <aside class="w-[15%]">
          <div class="flex flex-wrap mt-4">
            <a v-for="tag in tags" :key="tag.id" href="#" class=" m-1 px-2 py-1 w-fit rounded-full bg-gray-500 text-white">#{{ tag.label }}</a>
          </div>
        </aside>

        <div class="w-[80%]">
          <template v-if="articles.data.length > 0">
            <div>
              <CardArticle v-for="(article, articleIndex) in articles.data" :key="articleIndex" :data="article"
                url="articles" type="large" class="m-4"></CardArticle>
            </div>
            <Pagination :links="articles?.links" />
          </template>
          <template v-else>
            <p>Articles not found</p>
          </template>
        </div>
      </div>
    </section>

  </MainLayout>

</template>

<style scoped>
</style>
