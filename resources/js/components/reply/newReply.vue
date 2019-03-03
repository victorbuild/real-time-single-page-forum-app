<template>
  <div class="mt-4">
    <markdown-editor v-model="body"></markdown-editor>
    <v-btn icon @click="sumbit">
      <v-icon color="green">done</v-icon>
    </v-btn>
  </div>
</template>

<script>
export default {
  props:['questionSlug'],
  data(){
    return {
      body:null
    }
  },
  methods:{
    sumbit(){
      axios.post(`/api/question/${this.questionSlug}/reply`,{body:this.body})
      .then(res => {
        this.body = '';
        EventBus.$emit('newReply',res.data.reply);
        window.scrollTo(0,0);
      })
    }
  }
}
</script>

<style>

</style>
