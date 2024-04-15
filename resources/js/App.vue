<template>
  <div class="w-100 h-100">
    <div class="row m-3">
      <div class="col">
        <template v-if="canMakeMove">
          Twój ruch
        </template>
        <template v-else>
          Ruch przeciwnika
        </template>
      </div>
    </div>
    {{ board }}
    <div
      class="row m-3"
      style="border-left:1px solid black; border-top:1px solid black;"
    >
      <div
        v-for="(field, index) in board"
        :key="index"
        :class="'field col-4 text-center p-2 p-md-5 ' + (board[index] === 1 ? 'bg-success' : (board[index] === 2 ? 'bg-primary' : ''))"
        style="cursor: pointer; border-right:1px solid black; border-bottom: 1px solid black; font-size:64px"
        @click="pickField(index)"
      >
        <i
          v-if="board[index] === 1" 
          class="bi bi-circle"
        />
        <i
          v-else-if="board[index] === 2" 
          class="bi bi-x"
        />
        <i v-else class="bi bi-x" style="color: transparent"> </i>
      </div>
    </div>
    
  </div>
  
</template>

<script setup lang="ts">
import { ref } from 'vue';
import StartNewGameModal from './components/StartNewGameModal.vue'


const board = ref([
                  0,0,0,
                  0,0,0,
                  0,0,0
                ])

const canMakeMove = ref(true);
const isGameFinished = ref(false);

const pickField = (index: number) => {
  if (!canMakeMove.value) return;
  if (board.value[index] !== 0) return;
  canMakeMove.value = false;

  board.value[index] = 1;

  if(checkIfPlayerWon()) {
    endGame();
    return;
  }
  
  const indexes = board.value.map((item, index) => item === 0 ? index : null).filter(index => index !== null);
  if (indexes.length === 0) {
    endGame();
    return;
  }
  setTimeout(() => {
    const randomIndex = indexes[Math.floor(Math.random() * indexes.length)];
    board.value[randomIndex] = 2;
    canMakeMove.value = true;
  }, 800);
  
}

const checkIfPlayerWon = (): boolean => {
  for (let i = 0; i < 3; i++) {
    if (board.value[i * 3] === 1 && board.value[i * 3 + 1] === 1 && board.value[i * 3 + 2] === 1) {
      return true;
    }
    if (board.value[i] === 1 && board.value[i + 3] === 1 && board.value[i + 6] === 1) {
      return true;
    }
  }
  
  if (board.value[0] === 1 && board.value[4] === 1 && board.value[8] === 1) {
      return true;
  }
  if (board.value[2] === 1 && board.value[4] === 1 && board.value[6] === 1) {
      return true;
  }
  return false;
}

const endGame = () => {
  isGameFinished.value = true;
  canMakeMove.value = false;
}

const startGame = () => {
  isGameFinished.value = true;
  canMakeMove.value = true;
  board.value = [0,0,0, 0,0,0, 0,0,0];
}
</script>

<style scoped>
.field:hover{
  background: linear-gradient(135deg, black 0%, red 50%, black 100%);
  color:white;
}
</style>