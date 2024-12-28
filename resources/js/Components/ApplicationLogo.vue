<script setup>
function asset(path) {
    return `${import.meta.env.BASE_URL}${path}`;
}
</script>

<template>
    <div>
        <img :src="asset('storage/images/zppsu-logo-bg-removed.png')" alt="Logo" class="w-20 h-auto" />
    </div>
</template>
