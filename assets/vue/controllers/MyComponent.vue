<template>
    <div>Helloo {{ name }}!</div>
</template>

<script setup>
    defineProps({
        name: String
    });
</script>