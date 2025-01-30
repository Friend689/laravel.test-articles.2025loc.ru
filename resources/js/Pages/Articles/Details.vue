<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import axios from 'axios';
import { Head, useForm } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { useUtility } from '@/utils/utils';
import Icon from '@/Components/Icon.vue';
import CardComment from '@/Pages/Articles/Partials/CardComment.vue';

const { convertDateToHuman } = useUtility();

const sendingComment = ref(false);
const commentSent = ref(false);
const commentStatus = ref({
    success: 'in ',
    message: '',
})
const formComment = ref({
    subject: '123',
    body: '321',
});

const props = defineProps({
    article: Object
})

const updateLikes = async () => {
    const response = await axios.patch(`/api/articles/${props.article.id}/likes/inc`);
    props.article.likes = response.data.value;
}

const updateViews = async () => {
    const response = await axios.patch(`/api/articles/${props.article.id}/views/inc`);
    props.article.views = response.data.value;
}

const sendComment = async () => {
    sendingComment.value = true;
    commentSent.value = true;
    const response = await axios.put(`/api/articles/${props.article.id}/comment/add`, formComment.value);
    commentStatus.value = response.data;
    props.article.comments = response.data.value; //
};

onMounted(() => {
    setTimeout(() => {
        updateViews();
    }, 5000)
})
</script>

<template>

    <Head :title="`Статья - ${article.title}`" />

    <MainLayout>

        <section class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div>
                <div class="flex justify-between my-4 items-center">
                    <div class="flex items-center">
                        <span class="flex font-light text-gray-600"> {{
                            convertDateToHuman(article?.created_at) }} </span>
                        <div class="flex items-center">
                            <img class="mx-4 w-10 h-10 object-cover rounded-full hidden sm:block"
                                src="/images/avatar.jpg" alt="avatar">
                            <h1 class="text-gray-700 font-bold"> {{ article.author.name }} </h1>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex align-center">
                            <Icon @click="updateViews" icon="eye" class="mx-2" title="count views" />
                            <span>{{ article.views }}</span>
                        </div>
                        <div class="flex align-center">
                            <Icon @click="updateLikes" icon="favorite"
                                class="mx-2 cursor-pointer hover:fill-red-400 hover:stroke-red-400"
                                title="count likes" />
                            <span>{{ article.likes }}</span>
                        </div>
                    </div>
                </div>

                <div class="my-6">
                    <h2 class="text-2xl ">{{ article.title }}</h2>
                </div>

                <div class="flex justify-center">
                    <img class="max-h-[500px] rounded-lg" src="/images/card-large.jpg" alt="">
                </div>
                <div class="my-5">
                    <p>{{ article.content }}</p>
                </div>

                <div>
                    <div class="relative">
                        <template v-if="commentSent">
                            <div
                                class="h-full w-full rounded-md py-4 px-6 text-center bg-gray-300/75 text-black">
                                <p>Comment status: {{ commentStatus.status }} </p>
                                <span>{{ commentStatus.message }}</span>
                            </div>
                        </template>
                        <template v-else>
                            <form @submit.prevent="sendComment" class="p-5 border rounded-lg">
                                <h3 class="mb-3">Оставить комментарий</h3>
                                <div class="flex flex-col">
                                    <div>
                                        <label for="subject">Тема</label>
                                        <input id="subject" required name="subject" v-model="formComment.subject"
                                        class="w-full p-2 mb-3 rounded-lg" />
                                    </div>
                                    <div>
                                        <label for="body">Текст комментария</label>
                                        <textarea id="body" required name="body" v-model="formComment.body" class="p-2 w-full mb-3 rounded-lg"></textarea>
                                    </div>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="px-3 py-2 rounded-lg text-white bg-green-600 hover:bg-green-500 disabled:bg-gray-700">Отправить</button>
                                </div>
                            </form>
                        </template>


                    </div>
                    <div class="mt-4 p-3">
                        <CardComment v-for="(comment, commentIndex) in article.comments" :comment="comment" :key="comment.id" class="p-2 mb-3 border rounded-md flex justify-between items-center" />
                    </div>
                </div>
            </div>
        </section>

    </MainLayout>

</template>
