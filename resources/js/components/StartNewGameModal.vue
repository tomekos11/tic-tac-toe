<template>
  <div
    class="w-100 h-100 position-absolute d-flex justify-content-center align-items-center"
    style="background: hsla(0, 0%, 0%, 0.65);"
  >
    <div
      class="p-3 text-white d-flex flex-column justify-content-between"
      style="border-radius: 10px; background: black;"
    >
      <div class="row">
        <div class="col text-center py-2 display-6">
          <span v-if="props.result === 1">
            Wygrałeś, brawo
          </span>
          <span v-else-if="props.result === 0">
            Remis, następnym razem się uda
          </span>
          <span v-else>
            Przegrałeś, poćwicz...
          </span>
        </div>
        </div> 
      <div class="text-center">
        Chcesz zagrać jeszcze raz?<br>
        <button class="btn btn-md btn-dark" @click="emitStartGame()">
          Zagraj ponownie
        </button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { defineProps } from 'vue'

interface Props {
  result: number
}

const props = defineProps<Props>();
const emits = defineEmits(['startGame']);

const emitStartGame = () => {
  emits('startGame');
}
</script>
