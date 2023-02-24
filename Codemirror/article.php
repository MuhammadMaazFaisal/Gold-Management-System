<!doctype html>

  <title>XML: Display</title>
  <meta charset="utf-8" />
  <link href="../assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />
  <!-- <link rel="stylesheet" href="../assets/libs/@simonwep/pickr/themes/classic.min.css" />  -->
  <!-- <link rel="stylesheet" href="../assets/libs/@simonwep/pickr/themes/monolith.min.css" />  -->
  <link rel="stylesheet" href="../assets/libs/@simonwep/pickr/themes/nano.min.css" />
  <?php include '../layouts/head-style.php'; ?>
  <link rel=stylesheet href="../doc/docs.css">


<link rel="stylesheet" type="text/css" href="plugin/codemirror/lib/codemirror.css">
<link rel="stylesheet" href="plugin/codemirror/addon/hint/show-hint.css">
<script type="text/javascript" src="plugin/codemirror/lib/codemirror.js"></script>
<script src="plugin/codemirror/addon/hint/show-hint.js"></script>
<script src="plugin/codemirror/addon/hint/xml-hint.js"></script>
<script src="plugin/codemirror/mode/xml/xml.js"></script>
<style>
  .CodeMirror {
    border: 1px solid #eee;
    height:700px;
  }
</style>


<article>
  <h2>Article Xml Source File Display</h2>
  <?php 

    $path=$_GET['file_path'];
    $path = '../'.$path;
      $myfile = fopen($path, "r") or die("Unable to open file!");
    $text =  fread($myfile,filesize($path));
    fclose($myfile);
  ?>
  <form>
    <textarea id="code" name="code"><?php echo $text;?></textarea>
  </form>

    
    <script>
      var dummy = {
        attrs: {
          color: ["red", "green", "blue", "purple", "white", "black", "yellow"],
          size: ["large", "medium", "small"],
          description: null
        },
        children: []
      };

      var tags = {
        "!top": ["top"],
        "!attrs": {
          id: null,
          class: ["A", "B", "C"]
        },
        top: {
          attrs: {
            lang: ["en", "de", "fr", "nl"],
            freeform: null
          },
          children: ["animal", "plant"]
        },
        animal: {
          attrs: {
            name: null,
            isduck: ["yes", "no"]
          },
          children: ["wings", "feet", "body", "head", "tail"]
        },
        plant: {
          attrs: {name: null},
          children: ["leaves", "stem", "flowers"]
        },
        wings: dummy, feet: dummy, body: dummy, head: dummy, tail: dummy,
        leaves: dummy, stem: dummy, flowers: dummy
      };

      function completeAfter(cm, pred) {
        var cur = cm.getCursor();
        if (!pred || pred()) setTimeout(function() {
          if (!cm.state.completionActive)
            cm.showHint({completeSingle: false});
        }, 100);
        return CodeMirror.Pass;
      }

      function completeIfAfterLt(cm) {
        return completeAfter(cm, function() {
          var cur = cm.getCursor();
          return cm.getRange(CodeMirror.Pos(cur.line, cur.ch - 1), cur) == "<";
        });
      }

      function completeIfInTag(cm) {
        return completeAfter(cm, function() {
          var tok = cm.getTokenAt(cm.getCursor());
          if (tok.type == "string" && (!/['"]/.test(tok.string.charAt(tok.string.length - 1)) || tok.string.length == 1)) return false;
          var inner = CodeMirror.innerMode(cm.getMode(), tok.state).state;
          return inner.tagName;
        });
      }

      var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        mode: "xml",
        lineNumbers: true,
        extraKeys: {
          "'<'": completeAfter,
          "'/'": completeIfAfterLt,
          "' '": completeIfInTag,
          "'='": completeIfInTag,
          "Ctrl-Space": "autocomplete"
        },
        hintOptions: {schemaInfo: tags}
      });
    </script>

    <!-- 
    <script src="../assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="../assets/libs/@simonwep/pickr/pickr.min.js"></script>
    <script src="../assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>
    <script src="../assets/libs/flatpickr/flatpickr.min.js"></script>
    <script src="../assets/js/pages/form-advanced.init.js"></script>
    <script src="../assets/js/app.js"></script> -->
  </article>
