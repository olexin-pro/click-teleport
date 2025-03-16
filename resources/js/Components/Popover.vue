<script setup>
import {Popover, PopoverButton, PopoverPanel} from '@headlessui/vue'
import {ChevronDownIcon} from '@heroicons/vue/20/solid'
</script>

<template>
    <Popover v-slot="{ open }" class="relative">
        <PopoverButton class="focus:outline-none">
            <slot name="default">
                <ChevronDownIcon
                    :class="open ? 'text-indigo-300' : 'text-indigo-400'"
                    class="h-5 w-5 transition duration-150 ease-in-out group-hover:text-indigo-300"
                    aria-hidden="true"
                />
            </slot>
        </PopoverButton>

        <transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="translate-y-1 opacity-0"
            enter-to-class="translate-y-0 opacity-100"
            leave-active-class="transition duration-150 ease-in"
            leave-from-class="translate-y-0 opacity-100"
            leave-to-class="translate-y-1 opacity-0"
        >
            <div class="relative">
                <PopoverPanel
                    class="absolute left-0 z-10 mt-3 max-w-sm transform px-4 sm:px-0 lg:max-w-xl"
                >
                    <div class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black/5">
                        <div class="relative bg-white text-black p-4">
                            <slot name="content"/>
                        </div>
                        <div class="bg-gray-50 p-4" v-if="$slots.footer">
                            <slot name="footer"/>
                        </div>
                    </div>
                </PopoverPanel>
            </div>
        </transition>
    </Popover>
</template>

<style scoped>

</style>
