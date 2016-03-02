<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
 		<meta name="viewport" content="width=550px">
		<meta name="viewport" content="initial-scale=1.0">
		<title>University of Arizona Code Review</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<header>
				<h1>University of Arizona &lt;&nbsp;Code&nbsp;Review&nbsp;/></h1>
		</header>
<!--		<nav>
			<ul>
				<li><a href="index.html">Home.</a></li>	
				<li><a href="index.html">My Code</a></li>
				<li><a href="index.html">My Reviews.</a></li>
			</ul>
		</nav>
-->
		<section>
			<!-- SAMPLE CODE BLOCK -->
			<pre><code>
				<div id="code">#include &lt;stdio.h&gt;
#include &lt;string.h&gt;
#include <!--<span class="cspan" data-value="1"><button class="cmnt" data-value="<p class=&quot;input&quot; contenteditable=&quot;true&quot;><span class=&quot;placeholder&quot;>Insert comment here...</span></p><input type=&quot;text&quot; class=&quot;name&quot; placeholder=&quot;Name&quot; value=&quot;&quot;><button class=&quot;save&quot;>Save Comment</button></span>">(▼)</button><span class="comment" style="display: none;"></span></span>-->&lt;stdlib.h&gt;

//TODO: Create Student Struct (same as last drill)
typedef struct Student {
    int id;
    char* name;
    float percent;
    struct Student* nextStudent;
} Student;

//TODO: Create function CreateStudent (same as last drill)
void CreateStudent(Student** stuptr, char* name, float percent) {
	
    int id = -1;
    while (*stuptr != NULL) {
        id++;
        if ((*stuptr)-&gt;nextStudent != NULL) {
            stuptr = &((*stuptr)-&gt;nextStudent);
        } else {
            break;
        }
    }
    Student* newstu = (Student*)malloc(sizeof(Student));
    newstu-&gt;id = id+1;
    newstu-&gt;name = strdup(name);
    newstu-&gt;percent = percent;
    newstu-&gt;nextStudent = NULL;
    if ((*stuptr) != NULL) {
        (*stuptr)-&gt;nextStudent = newstu;
    } else {
        *stuptr = newstu;
    }
}

//TODO: Create function RemoveStudent
int RemoveStudent(Student** stuptr, int id) {
    int oneElF = 1;
    int foundElF = 0;
    while (*stuptr != NULL) {
        if ((*stuptr)-&gt;id == id) {
            foundElF = 1;
        }
        if ((*stuptr)-&gt;nextStudent != NULL) {
            oneElF = 0;
            if ((*stuptr)-&gt;nextStudent-&gt;id == id) {
                break;
            } else {
                stuptr = &((*stuptr)-&gt;nextStudent);
            }
        } else {
            break;
        }
    }
    if (foundElF == 0) {
        return -1;
    } else if (oneElF == 1) {
        *stuptr = NULL;
        return 0;
    } else {
        int id = (*stuptr)-&gt;nextStudent-&gt;id;
        (*stuptr)-&gt;nextStudent = (*stuptr)-&gt;nextStudent-&gt;nextStudent;
        return id;
    }
}

//Do not modify main
int main (void){
    
    int  numOps;
    int i;
    int id;
    float percent;
    int deleteResult;
    char name [20];
    char op;
    Student * studentList=NULL;
    
    scanf(&quot;%d&quot;,&numOps);
    
    //Loops through and does all the testing operations
    for (i=0; i&lt;numOps; i++){
        scanf(&quot; %c&quot;,&op);
        //Adds elements to Student array
        if(op==&#39;a&#39;){
            scanf(&quot;%s&quot;,name);
            scanf(&quot;%f&quot;,&percent);
            CreateStudent(&studentList, name, percent);
        }
        else{
            //Removes elements from Student array
            scanf(&quot;%d&quot;,&id);
            deleteResult=RemoveStudent(&studentList,id);
            if(deleteResult==-1){
                printf(&quot;%d delete failed &quot;,id);
            }
        }
    }
    while (studentList!=NULL){
        printf(&quot;%d %s %.2f &quot;,studentList-&gt;id,studentList-&gt;name,studentList-&gt;percent);
        studentList=studentList-&gt;nextStudent;
    }
}
				</div>
			</code></pre>
			<!-- END SAMPLE CODE BLOCK -->
		</section>
		<script src="/scripts/jquery-1.10.2.js"></script>
		<script src="/scripts/comments.js"></script>
		<script src="/scripts/footnote.js"></script>
		<footer>
			<p>By Alex Guyot, John Oney, Dakota Trotter, and Carson Stelzer.</p>
		</footer>
	</body>
</html>