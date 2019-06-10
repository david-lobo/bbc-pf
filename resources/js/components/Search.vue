<template>
  <div>
        <div class="media mb-3 border-bottom">
            <img class="mr-3" src="http://via.placeholder.com/194x109" alt="Card image cap">
            <div class="media-body">
                <h5 class="mt-0">The ARchers</h5>
                <p>Contemporary drama from the writers of 'The Archers'</p>
            </div>
        </div>

        <div class="media">
            <img class="mr-3" src="http://via.placeholder.com/194x109" alt="Card image cap">
            <div class="media-body">
                <h5 class="mt-0">The ARchers</h5>
                <p>Contemporary drama from the writers of 'The Archers'</p>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    
    export default {
        mounted() {
            console.log('Search Component mounted.')
        },
        async created () {
            const API_BASE_URL = process.env.MIX_API_BASE_URL;
            //axios.defaults.headers.common['Authorization'] = `Bearer ${await this.$auth.getAccessToken()}`
            try {
                const response = await axios.get(API_BASE_URL + '/search')
                this.players = response.data.data
                this.isLoading = false
            } catch (e) {
                // handle the authentication error here
            }
        }
    }
</script>
