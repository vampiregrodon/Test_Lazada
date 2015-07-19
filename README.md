<h1>MODULE : Restful</h1>


<h3>// Post *********************************************</h3>

1. Get a Post :
	GET http://localhost/zf2/public/json-restful-post
	params : {'id'=>'1'}

2. Get List Posts :
	GET http://localhost/zf2/public/json-restful-post	

3. Create a Post :
	POST http://localhost/zf2/public/json-restful-post	
	params : {'title'=>'input Title', 'content'=>'input Content'}

4. Update a Post :
	PUT http://localhost/zf2/public/json-restful-post	
	params : {'id'=>'1', 'title'=>'input New Title','content'=>'input New Content'}	

5. Delete a Post :
	DELETE http://localhost/zf2/public/json-restful-post	
	params : {'id'=>'1'}	



<h3>// Tags **********************************************</h3>

1. Get a Tag :
	GET http://localhost/zf2/public/json-restful-tags
	params : {'id'=>'1'}

2. Get List Tags :
	GET http://localhost/zf2/public/json-restful-tags

3. Create a Tag :
	POST http://localhost/zf2/public/json-restful-tags	
	params : {'post_id'=>'1', 'name'=>'input Name Tags'}	

4. Update a Tag :
	PUT http://localhost/zf2/public/json-restful-tags	
	params : {'id'=>'1','post_id'=>'2', 'name'=>'input New Name Tags'}	

5. DELETE a Tag :
	DELETE http://localhost/zf2/public/json-restful-tags	
	params : {'id'=>'1'}		



// Methods **********************************************

5. Select all posts by tag or tags :
	POST http://localhost/zf2/public/post/get-list-by-tag

	params : {'tag'=>'input Tag name',...}

6. Count posts by tag or tags :
	POST http://localhost/zf2/public/post/count-list-by-tag	
	
	params : {'tag'=>'input Tag name',....}


   