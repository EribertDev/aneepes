<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\ActualitesController;
use App\Http\Controllers\Users\NewsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Users\EventsController;
use App\Http\Controllers\AdminPollController;
use App\Http\Controllers\PollsController;
use App\Http\Controllers\SondageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\MembersController;




Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/admin', function () {
    return view('admin.home');
})->middleware(['auth', 'verified'])->name('admin');


//Route Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Staff
Route::get('/admin', [DashController::class,'index'])->name('dashboard');

Route::get('/staff', [MemberController::class, 'index'])->middleware(['auth', 'verified'])->name('staff');
Route::post('/users', [MemberController::class, 'store'])->name('users.store');
Route::put('/users/update/{id}', [MemberController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [MemberController::class, 'destroy'])->name('users.destroy');


// Route A propos
Route::get('about',[HomeController::class, 'about'])->name('about');

//Route actualités
Route::get('/actualites',[ NewsController::class, 'index'])->name('actualites');

//Route actualités detail
Route::get('/actualites/show/{id}',[NewsController::class,'show'])->name('actualites.show');


//Route évenements

Route::get('/event',[ EventsController::class, 'index'])->name('event');
Route::get('/event/show/{event}',[ EventsController::class, 'show'])->name('event.show');





// Route Blog 
Route::get('/register',function (){
    return view('auth.register');
});
//Route Contact
Route::get('/contact',function (){
    return view('layouts.contact');
})->name('contact');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');


//Route Sondage 
Route::get('/sondage',function (){
    return view('layouts.sondage');
})->name('sondage');

//ROUTE DON 
Route::get('/soutient/fneb',function (){
    return view('layouts.don');
})->name('don');

Route::get('payment/finish',function() {
    return view('layouts.paiement_finish');
});

//Route Newsletter
 //Route NewsLetter 
 Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
 ->name('newsletter.subscribe');
 
 Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])
 ->name('newsletter.unsubscribe');



//Route Actualites Admin 
Route::resource('actu', ActualitesController::class);
Route::get('news/index', [ActualitesController::class, 'index'])->name('news.index');
Route::get('news/create', [ActualitesController::class, 'create'])->name('news.create');
Route::get('news/show/{id}', [ActualitesController::class, 'show'])->name('news.show');
Route::post('/news/store', [ActualitesController::class, 'store'])->name('news.store');
Route::get('news/edit/{news}', [ActualitesController::class, 'edit'])->name('news.edit');
Route::put('news/update/{news}', [ActualitesController::class, 'update'])->name('news.update');
Route::delete('news/destroy/{news}', [ActualitesController::class, 'destroy'])->name('news.destroy');


//Route Evenenements Admin
Route::resource('even', EventController::class);
Route::get('events/index', [EventController::class, 'index'])->name('events.index');
Route::get('events/create', [EventController::class, 'create'])->name('events.create');
Route::get('events/show/{id}', [EventController::class, 'show'])->name('events.show');
Route::post('events/store', [EventController::class, 'store'])->name('events.store');
Route::get('events/edit/{event}', [EventController::class, 'edit'])->name('events.edit');
Route::put('events/update/{event}', [EventController::class, 'update'])->name('events.update');
Route::delete('events/delete/{event}', [EventController::class, 'destroy'])->name('events.destroy');



//Route Sondage Admin
Route::get('admin/polls/create', [AdminPollController::class, 'create'])->name('admin.polls.create');
Route::post('admin/polls/store', [AdminPollController::class, 'store'])->name('admin.polls.store');
Route::get('admin/polls/index', [AdminPollController::class, 'index'])->name('admin.polls.index');
Route::get('admin/polls/edit/{poll}', [AdminPollController::class, 'edit'])->name('admin.polls.edit');
Route::put('admin/polls/update/{poll}', [AdminPollController::class, 'update'])->name('admin.polls.update');
Route::delete('admin/polls/delete/{poll}', [AdminPollController::class, 'destroy'])->name('admin.polls.destroy');
Route::get('admin/polls/show/{poll}', [AdminPollController::class, 'show'])->name('admin.polls.show');



//Route Vote
Route::get('/sondages', [SondageController::class, 'index'])->name('sondage');
Route::get('/sondages/{poll}', [PollsController::class, 'show'])->name('polls.show');
Route::post('/sondages/{poll}/vote', [PollsController::class, 'vote'])->name('polls.vote');





//Route POST ADMIN
Route::get('admin/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
Route::post('admin/posts/store', [PostController::class, 'store'])->name('admin.posts.store');
Route::get('admin/posts/index', [PostController::class, 'index'])->name('admin.posts.index');
Route::get('admin/posts/edit/{post}', [PostController::class, 'edit'])->name('admin.posts.edit');
Route::put('admin/posts/update/{post}', [PostController::class, 'update'])->name('admin.posts.update');
Route::delete('admin/posts/delete/{post}', [PostController::class, 'destroy'])->name('admin.posts.destroy');
Route::get('admin/posts/show/{post}', [PostController::class, 'show'])->name('admin.posts.show');



 // Route Blog 
 Route::get('/blog', [BlogController::class, 'index'])->name('blog');
 Route::get('/blog/{post}', [BlogController::class, 'show'])->name('blog.show');




 Route::post('/blog/{post}/comments', [BlogController::class, 'storeComment'])
 ->name('blog.comments.store');
 //->middleware('auth');

Route::post('/blog/{post}/ratings', [BlogController::class, 'storeRating'])
 ->name('blog.ratings.store');


 Route::post('/posts/{post}/comments', [BlogController::class, 'storeComment'])
     ->name('posts.comments.store')
     ->middleware('auth');

Route::post('/posts/{post}/ratings', [BlogController::class, 'storeRating'])
     ->name('posts.ratings.store');


//Route Cotisation
Route::get('/cotisations', [SubscriptionController::class, 'index'])->name('subscriptions.index');
Route::get('/cotisations/paiement', [SubscriptionController::class, 'showPaymentForm'])->name('subscriptions.payment');
Route::post('/cotisations/process', [SubscriptionController::class, 'processPayment'])->name('subscriptions.process');
Route::post('/cotisations/verify', [SubscriptionController::class, 'handleCallback'])->name('subscriptions.callback');
Route::get('/cotisations/success', [SubscriptionController::class, 'success'])->name('subscriptions.success');
Route::get('/cotisations/check-pending/{id}', [SubscriptionController::class, 'checkPendingPayment']);
Route::get('/cotisations/failed', [SubscriptionController::class, 'failed'])->name('subscriptions.failed');

//Route Subscription
Route::get('/subscription',[SubscriptionController::class,'subscription'])->name('subscription');

//Route Members
Route::get('/members', [MembersController::class, 'index'])->name('members.index');
Route::post('/members', [MembersController::class, 'store'])->name('members.store');
Route::get('/members/create', [MembersController::class, 'create'])->name('members.create');
Route::get('/members/{member}/edit', [MembersController::class, 'edit'])->name('members.edit');
//Route::put('/members/update/{member}', [MembersController::class, 'update'])->name('members.update');
Route::delete('/members/{member}', [MembersController::class, 'destroy'])->name('members.destroy');
Route::put('/members/{member}', [MembersController::class, 'update'])->name('members.update');



require __DIR__.'/auth.php';
