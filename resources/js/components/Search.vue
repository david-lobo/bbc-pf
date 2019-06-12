<template>
  <div>
      <form>
        <div class="form-group">
          <input 
            v-model="term" 
            @input="searchProgrammes" 
            type="text" 
            class="form-control" 
            id="programmeSearch" 
            aria-describedby="programmeSearchHelp" 
            placeholder="Begin typing to search for a programme"
          >
        </div>
      </form>
      <div v-if="uiMessage.length > 0"><p>{{ uiMessage }}</p></div>
      <div v-else>
        <div v-for="(programme, index) in programmes" :key="index" class="media mb-3 border-bottom">
            <img class="mr-3" :src="programme.image_url" alt="Card image cap">
            <div class="media-body">
                <h5 class="mt-0">{{ programme.title }}</h5>
                <p>{{ programme.short_synopsis }}</p>
            </div>
        </div>
      </div>
    </div>
</template>

<script>
    import axios from 'axios'
import { setTimeout } from 'timers';
    export default {
        data() {
          return {
            term: '',
            isLoading: false,
            programmes: []
          }
        },
        computed: {
          uiMessage() {
            if (this.isLoading) {
              return 'Loading...'
            }

            if (this.term.length > 0 && this.programmes.length === 0) {
              return 'There are no results'
            }

            return ''
          }
        },
        methods: {
          searchProgrammes: _.debounce(function (e) {
            let vm = this
            if (vm.term.length > 0) {
              vm.fetchProgrammes()
            } else {
              vm.programmes = []
            }
          }, 1000),
          async fetchProgrammes () {
            let vm = this
            vm.isLoading = true
            const API_BASE_URL = process.env.MIX_API_BASE_URL
            try {
                const term = encodeURIComponent(vm.term)
                const response = await axios.get(API_BASE_URL + '/search?search=' + term)
                vm.isLoading = false
                vm.programmes = response.data.results
            } catch (e) {
                // handle errors here
            }
          }
        }
    }
</script>

<style scoped>
input, input:focus {
  background-color: #767676;
  border-color: #777777;
  color: #262525;
}

input:focus {
  box-shadow: 0 0 0 0.1rem rgba(250, 250, 250, 0.5)
}

input::placeholder {
  color: rgba(250, 250, 250, 0.5);
}
</style>