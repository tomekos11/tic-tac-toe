<template>
  <i v-if="fieldOwner === 1" class="bi bi-circle" />
  <i v-else-if="fieldOwner === 2" class="bi bi-x" />
  <i v-else class="bi bi-x" style="color: transparent" />
</template>

<script setup lang="ts">
import { DefineProps } from 'vue';

interface Props {
  fieldOwner: number
}

defineProps<Props>()
</script>