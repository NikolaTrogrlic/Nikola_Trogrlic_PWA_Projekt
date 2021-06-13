$(function() {
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("form[name='unos']").validate({
      // Specify validation rules
      rules: {
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
       naslov:{
          required:true,
          minlength:5,
          maxlength:30,
        },

        slika: {
          required: true,
      },
        skraceniSadrzaj: {
          required: true,
          minlength:10,
          maxlength:100,
        },
        sadrzaj:{
          required:true,
          minlength:1,
        },
        kategorija:{
          required:true,
        }
      },
      // Specify validation error messages
      messages: {
        naslov:{
            required:"Naslov vijesti mora biti unesen!",
            minlength:"Naslov vijest mora imati barem 5 znakova",
            maxlength:"Naslov vijesti može imati najviše 30 znakova"
        },
        slika: {
          required: "Slika mora biti odabrana",
        },
        skraceniSadrzaj: {
          required: "Kratki sadržaj mora biti unesen!",
          minlength:"Kratki sadržaj mora imati barem 10 znakova",
          maxlength:"Kratki sadržaj može imati najviše 100 znakova",
        },
        sadrzaj:{
          required: "Tekst vijesti ne smije biti prazan",
          minlength: "Tekst vijesti ne smije biti prazan",
        },
        kategorija:{
          required:"Kategorija mora biti odabrana",
        }
     },

      // Make sure the form is submitted to the destination defined
      // in the "action" attribute of the form when valid
      submitHandler: function(form) {
        form.submit();
      }
    });

    $("form[name='loginform']").validate({
      // Specify validation rules
      rules: {
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
       username:{
          required:true,
          minlength:4,
          maxlength:30,
        },
        password:{
          required:true,
          minlength:6,
        }

      },
      // Specify validation error messages
      messages: {
        username:{
            required:"Unesite korisničko ime!",
            minlength:"Korisničko ime mora imati barem 4 slova",
            maxlength:"Korisničko ime ne smije imati više od 30 slova",
        },
        password: {
          required: "Lozinka mora biti unesena",
          minlength:"Lozinka mora imati barem 6 znakova",
        },
     },

      // Make sure the form is submitted to the destination defined
      // in the "action" attribute of the form when valid
      submitHandler: function(form) {
        form.submit();
      }
    });
  });
