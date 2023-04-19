$(document).ready(function(){
    loadLeaderBoard()
})

var loadLeaderBoard = () => {
    ajax_request(window.location.href,'GET',{}).then( (res) => {
        $('#leader_board').html(res);
    });
}
