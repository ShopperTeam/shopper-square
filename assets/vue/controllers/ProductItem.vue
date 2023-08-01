<template>
    <div>
       <h5>
        {{ name }}
       </h5>
       <div>
           <img :src="photo" :alt="name" width="300">
       </div>
       <p>
        {{ description }}
       </p>
       <h5>
        {{ price }} €
       </h5>
    </div>
</template>

<script setup>
    defineProps({
        name: String,
        description: String,
        price: Number,
        photo: String
    });
</script>