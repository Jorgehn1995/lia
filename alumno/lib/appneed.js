query=window.location.search.substring(1);
q=query.split("&");
vars=[];
for(i=0;i<q.length;i++){
    x=q[i].split("=");
    k=x[0];
    v=x[1];
    vars[k]=v;
}
function loadicon(){
  var ld='<div class="col-md-12">'+
  '<div class="text-center">'+
      '<img src="../../assets/images/load1.gif" width="40px"  alt="">'+
    '</div>'+
  '</div>';
  return ld;
}
