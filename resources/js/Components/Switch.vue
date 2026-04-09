<script setup>
import { useTheme } from '@/Composables/useTheme'

defineProps({
  label: {
    type: String,
    default: '',
  },
})

const { isDark, toggleTheme } = useTheme()
</script>

<template>
  <label class="w-full inline-flex items-center justify-between cursor-pointer group select-none">
    <span class="select-none text-tiny ms-1 text-gray-700 dark:text-neutral-200">
      {{ label }}
    </span>

    <input
      type="checkbox"
      class="sr-only peer"
      :checked="isDark"
      @change="toggleTheme"
    />

    <div
      class="relative w-9 h-5 bg-gray-400
             peer-focus:outline-none peer-focus:ring-4
             peer-focus:ring-brand-soft dark:peer-focus:ring-brand-soft
             rounded-full peer-checked:after:translate-x-full
             rtl:peer-checked:after:-translate-x-full
             peer-checked:after:border-buffer
             after:content-[''] after:absolute after:top-[2px] after:start-[2px]
             after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all
             peer-checked:bg-brand"
    ></div>
  </label>
</template>
