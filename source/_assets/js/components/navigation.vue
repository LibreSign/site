<template>
    <div class="flex-1 lg:block md:border-b lg:border-b-0 pt-8 md:pt-1 pl-6 md:pl-0 pr-6 pb-2 mb-4 md:mb-6" :class="{ hidden: ! visible }">
        <nav class="nav-list" role="navigation">
            <navigation-item
                v-for="(url, key) in navigation"
                :key="key"
                :item="url">{{ key }}
            </navigation-item>
        </nav>
    </div>
</template>

<script>
import NavigationItem from './navigation-item.vue';

export default {
    components: { NavigationItem },

    props: {
        links: Object,
    },

    data() {
        return {
            navigation: this.links,
            visible: false,
        }
    },

    mounted() {
        this.$root.$on('menu-toggle', visible => {
            this.visible = visible;
        });
    },
}
</script>
