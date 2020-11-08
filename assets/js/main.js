function changeContent(content) {
  if(content == "landing") {
    $(".container").fadeOut(3000,function (){
      $(".container").fadeIn(3000,function (){
          // Do more stuff
      })
  })
  }
}


function openSearch() {
  $("#search-modal").fadeIn();
}

function closeSearch() {
  $("#search-modal").fadeOut(1000);
};

$('.delete-category').click(function(){
  var el = this;
 
  // Delete id
  var deleteid = $(this).data('id');

  var confirmalert = confirm("Are you sure you want to delete this category ?");
  if (confirmalert == true) {
     // AJAX Request
     $.ajax({
       url: 'categories',
       type: 'POST',
       data: { id:deleteid },
       success: function(response){

         if(response == 1){
           $(el).closest('li').fadeOut(800,function(){
           $(this).remove();
     });
         }else{
     alert('Invalid ID.');
         }

       }
     });
  }

});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$(function(){
  function buildQuiz(){
    // variable to store the HTML output
    const output = [];

    // for each question...
    myQuestions.forEach(
      (currentQuestion, questionNumber) => {

        // variable to store the list of possible answers
        const answers = [];

        // and for each available answer...
        for(letter in currentQuestion.answers){

          // ...add an HTML radio button
          answers.push(
            `<label>
              <input type="radio" name="question${questionNumber}" value="${letter}">
              ${letter} :
              ${currentQuestion.answers[letter]}
            </label>`
          );
        }

        // add this question and its answers to the output
        output.push(
          `<div class="question"> ${currentQuestion.question} </div>
          <div class="answers"> ${answers.join('')} </div>`
        );
      }
    );

    // finally combine our output list into one string of HTML and put it on the page
    quizContainer.innerHTML = output.join('');
  }

  function showResults(){

    // gather answer containers from our quiz
    const answerContainers = quizContainer.querySelectorAll('.answers');

    // keep track of user's answers
    let numCorrect = 0;


    // for each question...
    myQuestions.forEach( (currentQuestion, questionNumber) => {

      // find selected answer
      const answerContainer = answerContainers[questionNumber];
      const selector = `input[name=question${questionNumber}]:checked`;
      const userAnswer = (answerContainer.querySelector(selector) || {}).value;

      // if answer is correct
      if(userAnswer === currentQuestion.correctAnswer){
        // add to the number of correct answers
        numCorrect++;

        // color the answers green
        answerContainers[questionNumber].style.color = 'lightgreen';
      }
      // if answer is wrong or blank
      else{
        // color the answers red
        answerContainers[questionNumber].style.color = 'red';
      }
    });

    resultsContainer.innerHTML = `${numCorrect} tacnih od ${myQuestions.length}`;

    if(numCorrect > 2) {
      $(".quiz_register").fadeOut(3000,function (){
        $(".keep_register").fadeIn(3000,function (){
            // Do more stuff
        })
      })
    }

    
  }

  const quizContainer = document.getElementById('quiz');
  const resultsContainer = document.getElementById('results');
  const submitButton = document.getElementById('submit');
  const myQuestions = [
    {
      question: "Sta je Roleplay ?",
      answers: {
        a: "Roleplay je simuliranje voznje traktora",
        b: "Voznja konja bez sedla",
        c: "Roleplay je simuliranje st"
      },
      correctAnswer: "c"
    },
    {
      question: "Sta je Metagaming ?",
      answers: {
        a: "Kradja vozila popodne",
        b: "Mesanje IC i OOC informacija",
        c: "Kradja vozila uvece"
      },
      correctAnswer: "b"
    },
    {
      question: "Sta radis danas ??",
      answers: {
        a: "ucim",
        b: "ucim",
        c: "a ti ?",
        d: "Nista"
      },
      correctAnswer: "d"
    }
  ];

  // Kick things off
  buildQuiz();

  // Event listeners
  submitButton.addEventListener('click', showResults);
})();