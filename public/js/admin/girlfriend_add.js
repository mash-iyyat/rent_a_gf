$(document).ready(function() {
	$('.tag-chips').material_chip();
	$('#add-girlfriend-form').on('submit', function(e) {
		let girlfriendTags = $('.tag-chips').material_chip('data');
		e.preventDefault();
		let gfData = new FormData(this);
		/*============== post request for girlfriend ===============*/
		$.ajax({
			type: 'POST',
			url:`${url}/admin/girlfriend/create`,
			data: gfData,
			contentType:false,
			cache:false,
			processData:false
		}).done(res => {
			console.log(res);
			/*============== post request for tags ===============*/
				for(var x in girlfriendTags) {
					$.ajax({
						type:'POST',
						url:`${url}/admin/girlfriend/create/tag`,
						data: {
							_token: $('input[name=_token]').val(),
							tag: girlfriendTags[x].tag,
							girlfriend_id: res.girlfriend.id
						}
					}).done(res => {
						// console.log(res)
					}).fail(err => {
						console.log(err);
					})
				}
			/*============== post request for tags ===============*/
			Materialize.toast("Girlfriend Added", 2000);
			$('#username').val("");
			$('#rate').val("");
			$("#girlfriend").val("");
			$("#user_id").val("");
			$('.chip').remove();
			$('.tag-chips').material_chip({ data:[] });
			tinymce.activeEditor.setContent('');
		}).fail(err => {
			Materialize.Toast.removeAll();
			for(var x in err.responseJSON.errors) {
				Materialize.toast(err.responseJSON.errors[x], 10000 ,'red')
			}
		})
		/*============== post request for girlfriend ===============*/
	});
})

$(document).ready(function(){
	/*============== GET request for USER LIST ===============*/
	$('#girlfriend').on('keyup', function() {
		let searchUser = $(this).val();
		$.ajax({
			type:'GET',
			url:`${url}/admin/chooseuser/${searchUser}`
		}).done(res => {
			$('.collection-item').remove();
			let userData = res.user.data.map(user => {
				return {
					fullname: user.firstname + " " + user.lastname,
					user_id: user.id
				}
			})
			for(var x in userData) {
				$('#user-results').append(`
					<a href="#!" class="collection-item" onclick="setUserId(${userData[x].user_id}, '${userData[x].fullname}')">${userData[x].fullname}</a>
				`);	
			}
			// console.log(userData);
		}).fail(err => {
			console.log(err)
		})
	});
	/*============== GET request for USER LIST ===============*/
});

function setUserId(id, fullname) {
	$('#user_id').val(id);
	$('#girlfriend').val(fullname);
	$('.collection-item').remove();
}