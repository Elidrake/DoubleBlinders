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
				<h1><a href="/">University of Arizona &lt;&nbsp;Code&nbsp;Review&nbsp;/></a></h1>
		</header>
		<nav>
			<ul>
				<li><a href="/">Home</a></li>
				<li><a href="/review">Review</a></li>	
				<li><a href="/comments">Comments</a></li>
				<li><a href="/upload">Upload</a></li>
				<li><a href="/account/logout">Logout</a></li>
			</ul>
		</nav>
		<section>
			
			<h2>Welcome to your U of A Code Review home page!</h2>
			
			<p>If you haven't already, <a href="/upload">upload</a> your latest coding assignment.</p>
			
			<p>Once you've done that, other students can start leaving you comments. You can check the <a href="/comment">comments page</a> to see if any students have left you comments already.</p>
			
			<p>Once other students have uploaded their own code, you can check your <a href="/review">review page</a> to see if there is any code from other students that you have been assigned to review and comment on.</p>
			
			<h2>Reviewing another student's code</h2>
			
			<p>Commenting on another student's code is easy! Just tap or click within the code where you want to leave your comment and a new comment will be generated at that position. Tap or click on "Insert comment here", then type our your comment. When you're finished, just hit "Save Comment" and the comment will be anonymously sent. When the student who's code you commented on goes to their Comments page, they'll see your comment (although because all comments are anonymous, they won't know it was you who left it) in their code right where you inserted it!</p>
			
			<p>Feel free to test out the comment insertion system in the sample code below. When you're ready, check your <a href="/review">Review page</a> to see if you have been assigned any code to comment on yet.</p>
			
			<pre><code>
				<div id="code">#include &lt;stdio.h&gt;
#include &lt;string.h&gt;
#include &lt;stdlib.h&gt;

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