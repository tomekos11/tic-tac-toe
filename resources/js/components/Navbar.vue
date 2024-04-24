<template>
  <div class="py-2 bg-dark text-white justify-content-end d-flex align-items-center">
    <template v-if="stats.winsAmount !== -1">
      <span :class="animate === 1 ? 'animate-win': ''">
        {{ stats.winsAmount }}
      </span>
      &nbsp;/&nbsp;
      <span :class="animate === 0 ? 'animate-draw': ''">
        {{ stats.drawsAmount }}
      </span>
      &nbsp;/&nbsp;
      <span :class="animate === 2 ? 'animate-lose': ''">
        {{ stats.lossAmount }}
      </span>
    </template>
    <i class="bi bi-person-circle mx-3" style="font-size: 24px;"></i>
  </div>
</template>

<script setup lang="ts">
import { DefineProps, onUpdated, ref, watch } from 'vue';
const animate = ref(-1);

interface Stats {
  winsAmount: number,
  lossAmount: number,
  drawsAmount : number
}

interface Props {
  stats: Stats
}

const props = defineProps<Props>()

const startAnimation = (type: number) => {
  animate.value = type;
  setTimeout(() => {
    animate.value = -1;
  }, 1200);
}

watch(() => props.stats.winsAmount, (newVal, oldVal) => {
  if(oldVal === -1) return;
  startAnimation(1);
});

watch(() => props.stats.drawsAmount, (newVal, oldVal) => {
  if(oldVal === -1) return;
  startAnimation(0);
});

watch(() => props.stats.lossAmount, (newVal, oldVal) => {
  if(oldVal === -1) return;
  startAnimation(2);
});
</script>

<style scoped>
.animate-win {
  animation: animateWin 1200ms forwards;
}

.animate-draw {
  animation: animateDraw 1200ms forwards;
}

.animate-lose {
  animation: animateLose 1200ms forwards;
}

@keyframes animateWin {
  0% {
    transform: translateY(0);
    color: green;
  }
  80% {
    transform: translateY(-10px);
  }
  90% {
    color: greenyellow;
  }
  100% {
    transform: translateY(0);
    color:white;
  }
}

@keyframes animateDraw {
  0% {
    transform: translateY(0);
    color: gray;
  }
  80% {
    transform: translateY(-10px);
  }
  90% {
    color: rgb(60, 64, 55);
  }
  100% {
    transform: translateY(0);
    color:white;
  }
}

@keyframes animateLose {
  0% {
    transform: translateY(0);
    color: red;
  }
  80% {
    transform: translateY(-10px);
  }
  90% {
    color: rgb(156, 79, 79);
  }
  100% {
    transform: translateY(0);
    color:white;
  }
}
</style>