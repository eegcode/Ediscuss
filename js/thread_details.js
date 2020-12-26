const answerBtn = document.querySelectorAll('.answer-btn');
const commentBtn = document.querySelector('.comment-btn');
const addCommentBtn = document.querySelectorAll('.add-comment-btn');
const discardBtn = document.querySelectorAll('.comment-discard-btn');
const commentForm = document.querySelector('.comment-form-container');
const  threadEditBtn = document.querySelector('.edit-thread-btn');
const editThreadModalId = document.querySelector('#thread-edit-modal-id');
const editAnsBtn = document.querySelectorAll(".edit-answer-btn");
const editComBtn = document.querySelectorAll('#edit-comment-btn');



  if(window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
 }






answerBtn.forEach((btn)=>{
	btn.addEventListener('click',()=>{
	window.scrollTo(0,document.body.scrollHeight);
	});
});




function scrollToTop(){
	let scrollTop = window.scrollTop;
	if(scrollTop !== 0){
		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;
	};
}



		
addCommentBtn.forEach((btn)=>{
	btn.addEventListener('click',()=>{
		btn.parentElement.nextElementSibling.classList.remove("d-none");
	});
});



discardBtn.forEach((btn)=>{
	btn.addEventListener("click",()=>{
		const textArea = btn.previousElementSibling.previousElementSibling.children[0];
		const commentForm = btn.parentElement.parentElement;
		if(textArea.value.length > 0){
			if(confirm("Are you sure you want to discard your comment? \n Data you entered will be erased!")){
				textArea.value = "";
				commentForm.classList.add("d-none");
			}
			}else{
				textArea.value = "";
				commentForm.classList.add("d-none");
			}
			
	});
});


if(threadEditBtn){
	threadEditBtn.addEventListener('click',(e)=>{
		const threadEditDesc = document.getElementById('thread-edit-modal-description');
		const threadEditTitle = document.getElementById('thread-edit-modal-title');

		const btn = e.target;
		const threadDesc = e.target.parentElement.parentElement.previousElementSibling.previousElementSibling
			.innerHTML;
		const threadTitle = e.target.parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerHTML;
		editThreadModalId.value = btn.dataset["id"];

		threadEditDesc.value = threadDesc;
		threadEditTitle.value = threadTitle;

	});
}


if(editAnsBtn.length > 0){
	editAnsBtn.forEach((btn)=>{
		btn.addEventListener('click',(e)=>{
			const answerEditDesc = document.getElementById('answer-edit-modal-description');
			const btn = e.target;
			const ans_id = btn.dataset["id"];
			answerContainer = btn.parentElement.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling;

			let answer;
			if(answerContainer.classList.contains("answer-description")){
				answer =  answerContainer.innerHTML;
			}else{
				while(!answerContainer.classList.contains("answer-description")){
					answerContainer = answerContainer.previousElementSibling;
				}
				answer = answerContainer.innerHTML;
			}
			answerEditDesc.value = answer;

			document.getElementById('answer-edit-modal-id').value = ans_id;



		});
	});
}



if(editComBtn){
	editComBtn.forEach((btn)=>{
			btn.addEventListener('click',()=>{
			const comment = btn.parentElement.previousElementSibling.previousElementSibling.innerHTML;
			const editComBox = document.querySelector('.edit-comment-box');
			const commentEditId = btn.dataset["id"];
			document.getElementById('edit-com-id').value = commentEditId;
			editComBox.value = comment;


		});
	});
}


			



