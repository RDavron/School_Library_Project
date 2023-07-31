const div = document.getElementById('div');

const divClick = () => {
  alert('divがクリックされました');
};
function imgLeft_Click(){
  // 削除を確定する。
  window.location.href = 'delete_ok.html';

  //submit()でフォームの内容を送信
  // document.myform.submit();
  
}
function imgRight_Click(){
  // 前の画面に戻る。
  window.location.href = 'create_ok.html';
  
}

div.addEventListener('click', divClick);