@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
        <button type="button" class="close-alert" onclick="this.parentElement.style.display='none'">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i>
        {{ session('error') }}
        <button type="button" class="close-alert" onclick="this.parentElement.style.display='none'">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle"></i>
        {{ session('warning') }}
        <button type="button" class="close-alert" onclick="this.parentElement.style.display='none'">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i>
        <strong>Veuillez corriger les erreurs suivantes :</strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close-alert" onclick="this.parentElement.style.display='none'">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif

