<template>
    <div>
        <div>
            <nav-bar />
        </div>
        <div class="container mx-auto">
            <router-view class="p-6" v-slot="{ Component }">
                <component :is="Component" />
            </router-view>
        </div>
    </div>
</template>

<script>
import NavBar from "./NavBar.vue";
export default {
    components: {
        NavBar,
    },
};
</script>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
