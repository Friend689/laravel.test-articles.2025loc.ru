<script setup>
import { ref, computed } from 'vue';
import { useUtility } from '@/utils/utils';
const { convertDateToHuman } = useUtility();

const isExpanded = ref(false);

const props = defineProps({
    comment: Object
})

const showButton = computed(() => {
    return props.comment.body.length > 200;
});

const truncatedText = computed(() => {
    return !isExpanded.value
        ? props.comment.body.slice(0, 200) + '...'
        : props.comment.body;
});

const toggleExpand = () => {
    isExpanded.value = !isExpanded.value;
};
</script>

<template>
    <div>
        <div>
            <p class="underline mb-3">{{ comment.subject }}</p>
            <p>{{ truncatedText }} </p>
            <button v-if="showButton" class="text-blue-600 underline"  @click="toggleExpand">
                {{ isExpanded ? 'Свернуть' : 'Показать больше' }}
            </button>
        </div>
        <div class="ms-3 self-start">
            <span>{{ convertDateToHuman(comment.created_at) }}</span>
        </div>
    </div>
</template>
