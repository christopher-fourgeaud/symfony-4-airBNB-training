$('#add-image').on("click",function(){
    //on récupère le dernier index
    const lastIndex = $('#ad_images div.form-group').last().attr('id');

    //on incrémente cet index si >0
    const newIndex = lastIndex?parseInt(lastIndex.match('[0-9]+'))+1:0;

    //on modifie donc le prototype fourni par symfony
    const proto = $('#ad_images').data('prototype').replace(/__name__/g, newIndex);
    
    //on injecte le code obtenu dans l'élement
    $('#ad_images').append(proto);

    handleDeletebuttons();
});
function handleDeletebuttons(){
    $('button[data-action="delete"]').click(function(){
        const target = this.dataset.target;
        $(target).remove();
    })
}
handleDeletebuttons();