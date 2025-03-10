<template>
    <li class="list-group-item p-0 mb-1 text-sm">
        <a :href="item.root" class="text-blue-darker hover:text-purple font-normal"
            :class="{ 'text-purple-dark font-semibold': isActive(item.root) }">
            <slot></slot>
        </a>

        <ul v-if="item.children" class="p-0 text-sm">
            <li :key="key" v-for="(child, key) in item.children" class="list-group-item ps-3">
                <a :href="child.root" class="text-blue-dark hover:text-purple font-normal"
                :class="{ 'text-purple-dark font-semibold': isActive(child.root) }">
                    {{ key }}
                </a>

                <navigation-item v-if="item.children" :item="child"></navigation-item>
            </li>
        </ul>
    </li>
</template>

<script>
export default {
    name: 'navigation-item',

    props: {
        item: {
            type: Object,
            required: true,
        },
    },

    methods: {
        isActive(url) {
            return window.location.href.indexOf(url) > -1;
        },
    },
}
</script>

