<template>
  <start-new-game-modal v-if="isGameFinished"/>

  <div class="w-100 h-100">
    <div
      class="row m-3 position-relative"
      style="border-left:1px solid black; border-top:1px solid black;"
    >
      <div
        v-for="(field, index) in board"
        :key="index"
        :class="'field col-4 text-center p-2 p-md-5 ' + (board[index] === 1 ? 'bg-success-gradient' : (board[index] === 2 ? 'bg-primary-gradient' : ''))"
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

      <div
        v-if="isGameFinished"
        class="w-100 h-100 position-absolute d-flex justify-content-center align-items-center"
        style="background: hsla(0, 0%, 0%, 0.65);"
      >
        <div
          class="p-3 text-white d-flex flex-column justify-content-between"
          style="border-radius: 10px; background: black;"
        >
          <div class="row">
            <div class="col text-center py-2 display-6">
              <span v-if="result === 1">
                Wygrałeś, brawo
              </span>
              <span v-else-if="result === 0">
                Remis, następnym razem się uda
              </span>
              <span v-else>
                Przegrałeś, poćwicz...
              </span>
            </div>
           </div> 
          <div class="text-center">
            Chcesz zagrać jeszcze raz?<br>
            <button class="btn btn-md btn-dark" @click="startGame()">
              Zagraj ponownie
            </button>
          </div>
        </div>
      </div>
      <span class="position-absolute top-0 end-0 m-1 border border-black border-2 bg-dark text-white" style="width:fit-content; border-radius: 10px;">
        <template v-if="canMakeMove">
          Gracz
        </template>
        <template v-else>
          Bot
        </template>
      </span>
    </div>
    
  </div>
  
</template>

<script setup lang="ts">
import { ref } from 'vue';
import StartNewGameModal from './components/StartNewGameModal.vue'
import axios from 'axios';

const board = ref([
                  0,0,0,
                  0,0,0,
                  0,0,0
                ])

const canMakeMove = ref(true);
const isGameFinished = ref(false);
const result = ref(-1);
const movesCounter = ref(0);
const firstMove = ref(1);

const pickField = (index: number) => {
  if (!canMakeMove.value) return;
  if (board.value[index] !== 0) return;
  canMakeMove.value = false;

  board.value[index] = 1;
  movesCounter.value++;

  if(checkIfPlayerWon(1)) {
    result.value = 1;
    endGame();
    return;
  }
  
  botMakesMove(800);
}

const checkIfPlayerWon = (player: number): boolean => {
  for (let i = 0; i < 3; i++) {
    if (board.value[i * 3] === player && board.value[i * 3 + 1] === player && board.value[i * 3 + 2] === player) {
      return true;
    }
    if (board.value[i] === player && board.value[i + 3] === player && board.value[i + 6] === player) {
      return true;
    }
  }
  
  if (board.value[0] === player && board.value[4] === player && board.value[8] === player) {
      return true;
  }
  if (board.value[2] === player && board.value[4] === player && board.value[6] === player) {
      return true;
  }
  return false;
}

const endGame = () => {
  isGameFinished.value = true;
  canMakeMove.value = false;
  axios.post('/api/save-result', {
    'movesCounter': movesCounter.value,
    'result': result.value,
    'board': board.value,
    'firstMove': firstMove.value
  })
}

const startGame = () => {
  isGameFinished.value = false;
  board.value = [0,0,0, 0,0,0, 0,0,0];
  result.value = -1;
  movesCounter.value = 0;
  firstMove.value = 1;

  if(Math.round(Math.random())) {
    firstMove.value = 0;
    canMakeMove.value = false;
    botMakesMove(200);
  }

  canMakeMove.value = true;
}

const botMakesMove = (delay: number) => {
  const indexes = board.value.map((item, index) => item === 0 ? index : null).filter(index => index !== null);
  if (indexes.length === 0) {
    result.value = 0;
    endGame();
    return;
  }
  setTimeout(() => {
    const randomIndex = indexes[Math.floor(Math.random() * indexes.length)];
    board.value[randomIndex] = 2;
    if(checkIfPlayerWon(2)) {
      result.value = 2;
      endGame();
      return;
    }
    canMakeMove.value = true;
  }, delay);
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