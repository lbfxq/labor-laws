var GameMap = {
        options: {
        	size:2,
        	maxnum:2,
        	maxnum_enum:1,
        	sum:0
        },
        init:function(options){
        	this.options=options;
        },
        initmap:function(content){
        	var constr=JSON.parse(content);
        	var content=this.getMap(constr);
            
        	$("#game_map_content").html(content);

        },
        updateSum:function(){
           var sum=0;
           $(".mapdata").each(function(){
                var d=$(this).val();
                d=parseInt(d);
                sum+=d;
           });
           return sum;
        },
        build:function (options) {
        	this.init(options);
        	var size=parseInt(this.options.size);

        	var res = new Array();
        	for(i=0;i<size;i++){
        		var subres=new Array();
        		for(j=0;j<size;j++){
        			subres.push(0);
        		}
        		res.push(subres);
        	}

        	res=this.getGameData(res);
        	var constr=JSON.stringify(res);
        	var content=this.getMap(res);
        	$("#game_map_content").html(content);
        	//$("#content").val(constr);
        	this.options.sum=this.getSum(res);
        },
        getGameData:function(data){
        	var size=parseInt(this.options.size);
        	var maxnum=parseInt(this.options.maxnum);
        	var maxnum_enum=parseInt(this.options.maxnum_enum);
        	var maxwhile=100000;//最多循环次数
        	var numwhile=0;
            var mapdata=[[1],[2],[3],[4],[1,2],[1,3],[1,4],[1,2,3],[1,2,4],[1,2,3,4],[2,3],[2,4],[2,3,4],[3,4]];
            //var mapdata=[[1],[2],[3],[4]];

        	while(numwhile < maxwhile){
        		var data_maxnum = parseInt(this.getMaxNum(data));
        		var data_maxnum_enum= parseInt(this.getMaxNumEnum(data,data_maxnum));

        		if(data_maxnum == maxnum && data_maxnum_enum==maxnum_enum){
        			break;
        		}else{
                    sudata=new Array();
        			var sudata=this.clone(data);

        			var pos=this.getPos(size);
        			var current= sudata[pos.x][pos.y];
                    var maxindex=size-1;

                    var radindex=this.getRandomNum(0,3);
                    radata=mapdata[radindex];
                    for(var i=0;i<radata.length;i++){
                        var fx=radata[i];
                        switch(fx)
                        {
                            case 1:
                                //----往左退1-------------
                                var y=pos.y-1;
                                if(y >=0){
                                    sudata[pos.x][y]+=1;
                                    current+=1;
                                }
                              break;
                            case 2:
                                //----往右加1-------------
                                var y=pos.y+1;
                                if(y <= maxindex){
                                    sudata[pos.x][y]+=1;
                                    current+=1;
                                }
                              break;
                            case 3:
                                //----往上加1-------------
                                var x=pos.x -1;
                                if(x >= 0){
                                    sudata[x][pos.y]+=1;
                                    current+=1;
                                }
                                break;
                            case 4:
                                //----往下加1-------------
                                var x=pos.x+1;
                                if(x <= maxindex){
                                    sudata[x][pos.y]+=1;
                                    current+=1;
                                }
                              break;
                            default:
                              break;
                        }
                    }


        			sudata[pos.x][pos.y]=current;

   



        			var data_sub_maxnum = this.getMaxNum(sudata);
        		    var data_sub_maxnum_enum= this.getMaxNumEnum(sudata,data_sub_maxnum);

        		    if(data_sub_maxnum > maxnum || (data_sub_maxnum == maxnum && data_sub_maxnum_enum > maxnum_enum)){//当最大的数出现的次数超过的时候，重新生成
        		    	numwhile++;//循环次数加1
                        continue;
        		    }else{
        		    	data=sudata;
        		    }
        		}
        		numwhile++;//循环次数加1
        	}
            console.log(numwhile);
        	return data;
        },
        getMaxNum:function(data){
        	var maxnum=0;
        	for(i=0;i<data.length;i++){
        		for(j=0;j<data[i].length;j++){
        			if(data[i][j] >maxnum){
        				maxnum=data[i][j];
        			}
        		}
        	}
        	return maxnum;
        },
        getMaxNumEnum:function(data,maxnum){
        	var maxnum_enum=0;
        	for(i=0;i<data.length;i++){
        		for(j=0;j<data[i].length;j++){
        			if(data[i][j] == maxnum){
        				++maxnum_enum;
        			}
        		}
        	}
        	return maxnum_enum;
        },
        getSum:function(data){
			var sum=0;
        	for(i=0;i<data.length;i++){
        		for(j=0;j<data[i].length;j++){
        			sum+=data[i][j];
        		}
        	}
        	return sum;
        },
        getPos:function(size){
        	var pos={
        		x:this.getRandomNum(0,size-1),
        		y:this.getRandomNum(0,size-1),
        	};
        	return pos;
        },
        getRandomNum:function(Min,Max){
        	var Range = Max - Min;   
			var Rand = Math.random();   
			return(Min + Math.round(Rand * Range));   
        },
        getMap:function(data){
            var maxnum=parseInt(this.options.maxnum);
        	var content="";
        	var num=data.length;
        	var colw=Math.floor(12/num);
        	for(i=0;i<data.length;i++){
        		content+='<div class="row show-grid m-b-xxs m-t-none">';
        		for(j=0;j<data[i].length;j++){
                    if(maxnum==data[i][j]){
                        content+='<div class="col-md-'+colw+'" style="padding:5px;text-align:center;color:#f00;"><input type="text" name="map['+i+']['+j+']" value="'+data[i][j]+'" style="width:80%" class="mapdata" /> </div>';
                    }else{
                        content+='<div class="col-md-'+colw+'" style="padding:5px;text-align:center;"><input type="text" name="map['+i+']['+j+']" value="'+data[i][j]+'" style="width:80%" class="mapdata" /> </div>';  
                    }
        		}
        		content+='</div>';
        	}
        	return content;
        },
        clone:function(data){
            var c=new Array();
            for(var i=0;i<data.length;i++){
                s=new Array();
                for(var j=0;j<data[i].length;j++){
                    s[j]=data[i][j];
                }
                c[i]=s;
            }
            return c;
        }
    };
