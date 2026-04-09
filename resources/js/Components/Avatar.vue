<script setup>
const props = defineProps({
    name: {
        type: String,
        required: true
    },
    size: {
        type: String,
        default: '50'
    }
});

const initials = props.name.split(' ').map(n => n[0]).join('').toUpperCase();
</script>

<template>
    <div
        class="flex items-center justify-center rounded-full bg-teal-50 text-violet-400 font-bold"
        :style="{ width: props.size + 'px', height: props.size + 'px' }"
    >
        {{ initials }}
    </div>
</template>
