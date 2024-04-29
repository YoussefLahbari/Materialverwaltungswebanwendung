<div>
    @if(session('alert'))
    <tr>
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <strong>Opération reussite!</strong> {{session('alert')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
      </tr>
    @elseif(session('user'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <strong>Utilisateur ajouter avec success!</strong> Nom: {{session('user')->name}} & Email: {{session('user')->email}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session('deletedMat'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <strong>Materiel Supprimé avec success!</strong> Marque: 
        {{session('deletedMat')->marque}} 
        & Model: {{session('deletedMat')->model}}
        && N° inventaire {{session('deletedMat')->numero_inventaire}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
@php 
session()->forget('alert');
session()->forget('user');
session()->forget('deletedMat');
@endphp
</div>