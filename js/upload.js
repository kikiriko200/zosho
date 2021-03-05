$(document).ready(function(){
  $('#auto').click(function(){
    var isbn = $('#isbn').val();
    $.ajax({ // json読み込み開始
      type: 'GET',
      url: 'https://api.openbd.jp/v1/get?isbn='+isbn,
      dataType: 'json'
    })
    .then(
      function(json){
        console.log('Openbd読み込み成功');
        var title = json[0]['summary']['title'];
        var author = json[0]['summary']['author'];
        var cover = 'https://cover.openbd.jp/'+isbn+'_0.jpg';
        var publisher = json[0]['summary']['publisher'];
        var about = json[0]['onix']['CollateralDetail']['TextContent'];

        // 値設定
        console.log(isbn);
        $('#title').val(title);
        $('#author').val(author);
        $('#imgpath').val(cover);
        $('#publisher').val(publisher);
        var matchData = about.filter(function(item, index){
          if (item.TextType == "03") return true;
        });
        $('#about').val(matchData[0]['Text']);
      },
      function(){
        console.log('Openbd読み込み失敗');
      }
    )
  });
  $('#noIsbn').click(function(){
    $('#isbn').val('NoISBN');
  })
})
