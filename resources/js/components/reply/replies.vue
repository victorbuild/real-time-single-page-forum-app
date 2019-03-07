<template>
  <v-container>
    <reply
      v-for="(reply,index) in content"
      :data="reply"
      :index=index
      v-if="content"
      :key="reply.id"></reply>
  </v-container>
</template>

<script>
import Reply from './reply';

export default {
  components:{Reply},
  data(){
    return {
      content:this.question.replies
    }
  },
  props:['question'],
  created(){
    this.listen()
  },
  methods:{
    listen(){
      EventBus.$on('newReply',(reply) => {
        this.content.unshift(reply);
      });

      EventBus.$on('deleteReply',(index)=>{
        axios.delete(`/api/question/${this.question.slug}/reply/${this.content[index].id}`)
        .then(res => {
          this.content.splice(index,1);
        })
      });

      Echo.private('App.User.' + User.id())
          .notification((notification) => {
              this.content.unshift(notification.reply);
          });

      Echo.channel('deleteReplyChannel')
          .listen('DeleteReplyEvent',(e)=>{
            this.content=this.content.filter(function(item){
              return item.id != e.id
            });
          });
    }
  }
}
</script>

<style>

</style>
