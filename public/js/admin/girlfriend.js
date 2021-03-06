class Girlfriend {
  constructor(id, firstname, lastname, username, rate, email, contact, image, status, availability) {
    this.id = id;
    this.fullname = firstname + " " + lastname;
    this.username = username;
    this.rate = rate;
    this.email = email;
    this.contact = contact;
    this.image = image;
    this.status = status;
    this.availability = availability;
  }

  girlfriendTableRow() {
    return `
      <tr class="girlfriend-table-row tr-${this.id}">
        <td class="td-${this.id}"><b>${this.username}</b> (${this.fullname})</td>
        <td class="td-${this.id}">${this.email}</td>
        <td class="td-${this.id}">${this.contact}</td>
        <td class="td-${this.id}"><b>$${this.rate}.00</b></td>
        <td class="td-${this.id}">
          <button class="btn btn-flat waves-effect waves-light green lighten-1 white-text modal-trigger" href="#edit-gf-modal" onclick="findGirlfriendData(${this.id})">
            <i class="fa fa-pencil"></i>
          </button>
          <button class="btn btn-flat waves-effect waves-light red lighten-1 white-text" onclick="archiveGirlfriend(${this.id})">
            <i class="fa fa-trash"></i>
          </button>
        </td>
      </tr>
    `
  }

  girlfriendTableData() {
    return `
      <td class="td-${this.id}"><b>${this.username}</b> (${this.fullname})</td>
      <td class="td-${this.id}">${this.email}</td>
      <td class="td-${this.id}">${this.contact}</td>
      <td class="td-${this.id}"><b>$${this.rate}.00</b></td>
      <td class="td-${this.id}">
        <button class="btn btn-flat waves-effect waves-light green lighten-1 white-text modal-trigger" href="#edit-gf-modal" onclick="findGirlfriendData(${this.id})">
          <i class="fa fa-pencil"></i>
        </button>
        <button class="btn btn-flat waves-effect waves-light red lighten-1 white-text" onclick="archiveGirlfriend(${this.id})">
          <i class="fa fa-trash"></i>
        </button>
      </td>
    `
  }

  searchedGirlfriendTableRow() {
    return `
      <tr class="searched-girlfriend-table-row tr-${this.id}">
        <td class="td-${this.id}"><b>${this.username}</b> (${this.fullname})</td>
        <td class="td-${this.id}">${this.email}</td>
        <td class="td-${this.id}">${this.contact}</td>
        <td class="td-${this.id}"><b>$${this.rate}.00</b></td>
        <td class="td-${this.id}">
          <button class="btn btn-flat waves-effect waves-light green lighten-1 white-text modal-trigger" href="#edit-gf-modal" onclick="findGirlfriendData(${this.id})">
            <i class="fa fa-pencil"></i>
          </button>
          <button class="btn btn-flat waves-effect waves-light red lighten-1 white-text">
            <i class="fa fa-trash"></i>
          </button>
        </td>
      </tr>
    `
  }

  girlfriendRequestRow() {
    return `
      <tr class="girlfriend-request-table-row" id="tr-${this.id}">
        <td>
          <button class="btn btn-flat blue lighten-1 waves-light waves-effect white-text">
            <i class="fa fa-eye"></i>
          </button>
        </td>
        <td>${this.username}</td>
        <td>${this.email}</td>
        <td>$${this.rate}.00</td>
        <td>#${this.contact}</td>
        <td>
          <button class="btn btn-flat green lighten-1 waves-light waves-effect white-text" onclick="acceptRequest('${this.id}')">
            <i class="fa fa-check"></i>
          </button>
          <button class="btn btn-flat red lighten-1 waves-light waves-effect white-text" onclick="declineRequest('${this.id}')">
            <i class="fa fa-times"></i>
          </button>
        </td>
      </tr>
    `
  }

  girlfriendArchiveRow() {
    return `
    <tr class="girlfriend-table-row tr-${this.id}">
      <td class="td-${this.id}"><b>${this.username}</b> (${this.fullname})</td>
      <td class="td-${this.id}">${this.email}</td>
      <td class="td-${this.id}">${this.contact}</td>
      <td class="td-${this.id}"><b>$${this.rate}.00</b></td>
      <td class="td-${this.id}">
        <button class="btn btn-flat waves-effect waves-light green lighten-1 white-text" onclick="removeArchive(${this.id})">
          <i class="fa fa-check"></i>
        </button>
      </td>
    </tr>
    `;
  }

  girlfriendCard() {
    let profileImage = "";
    if (this.image == 'no-image.jpg') {
      profileImage = `<img src="/images/avatar.jpg" class="profile-image">`;
    }else {
      profileImage = `<img src="/storage/images/profiles/${this.image}">`;
    }
    return `
      <div class="col l3 s6 searched-card">
        <div class="card rent-card">
          <div class="card-content">
            <div class="rent-image">
              ${profileImage}
            </div>
            <span class="card-title rent-card-title">
              ${this.username} <br>
              <b>$ ${this.rate}.00</b>
            </span>
          </div>
          <div class="card-action">
            <a href="rent/girlfriend/${this.username}" class="btn btn-flat blue lighten-1 waves-effect waves-light white-text view-rent-btn">
              Rent
            </a>
          </div>
        </div>
      </div> 
    `
  }
}

let girlfriendId = 0;
function findGirlfriendData(id) {
  $.ajax({
    type:'GET',
    url:`${url}/admin/girlfriend/find/${id}`
  }).done(res => {
    console.log(res);
    girlfriendId = res.girlfriend.id;
    $('#username').val(res.girlfriend.username);
    $('#rate').val(res.girlfriend.rate);
    $('#description').prepend(res.girlfriend.description);
    $('#username').val(res.girlfriend.username);
    $('#girlfriend').val(res.user.firstname + " "+ res.user.lastname);
    $('#user_id').val(res.user.id);
    $(tinymce.get('description').getBody()).html(res.girlfriend.description);
    var tagsArray = [];
    for(var x in res.tags) {
      tagsArray.push({
        tag:res.tags[x].tag
      });
    }
    $('.tag-chips').material_chip({
      data:tagsArray
    });
  }).fail(err => {  
    console.log(err)
  })
}

function archiveGirlfriend(id) {
  loader();
  swal({
    text: "Archive selected Girlfriend..?",
    icon: "warning",
    buttons: true,
    dangerMode: true
  }).then((willArchive) => {
    loader();
    if(willArchive) {
      $.ajax({
        type:'post',
        url:`${url}/admin/girlfriend/archive/${id}`,
        data: {
          _token:$('input[name=_token]').val()
        }
      }).done((res) => {
        swal({
          icon: 'success',
          text:"Girlfriend sent to archive"
        });
        $(`.tr-${id}`).remove();
      }).fail((err) => {
        console.log(err);
      });
    }
  });
}