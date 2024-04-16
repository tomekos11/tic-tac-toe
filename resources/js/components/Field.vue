<template>
  <div
    :class="'field col-4 text-center p-2 p-md-5 ' + (fieldOwner === 1 ? 'bg-success-gradient' : (fieldOwner === 2 ? 'bg-primary-gradient' : ''))"
    style="cursor: pointer; border-right:1px solid black; border-bottom: 1px solid black; font-size:64px"
    @click="emitPickField()"
  >
    <field-icon :field-owner="fieldOwner"/>
  </div>
</template>

<script setup lang="ts">
import { defineProps } from 'vue'
import FieldIcon from './FieldIcon.vue';
interface Props {
  fieldOwner: number
}

const props = defineProps<Props>();
const emits = defineEmits(['pickField']);

const emitPickField = () => {
  emits('pickField');
}
</script>

<style scoped>
.field:hover{
  box-shadow: 0 0 31px 4px #42445A inset;
}

.bg-success-gradient {
  background: linear-gradient(225deg, black 0%, green 50%, black 100%);
  color:white;
}

.bg-primary-gradient {
  background: linear-gradient(135deg, black 0%, red 50%, black 100%);
  color:white;
}

</style>